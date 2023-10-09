<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Tag;
use App\Models\TagPost;
use App\Models\Topic;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PostsController extends Controller
{
    public function show($id, $page = 1)
    {
        $post = Post::findOrFail($id);
        $tags = TagPost::where('post_id','=',$id)->with('tag')->get();
        $replies = Reply::where('post_id', '=', $post->id)->with('user')->paginate(15);

        //getReplies (With optional pageination value)

        return Inertia::render('ViewPost', [
            'post' => $post,
            'replies'=>$replies,
            'tags'=>$tags
        ]);
    }

    public function getTags(string $s = '')
    {
        if($s == '')
        {
            return Tag::all();
        }else{
            return Tag::where('name', 'LIKE', '%'.$s.'%')->get();
        }
    }

    public function getPostTags(string $id)
    {
        return TagPost::where('post_id', '=', $id)->with('tag')->get();
    }

    public function getPostsWithFilters(array $s)
    {
        $posts = Post::whereHas('tags', function ($q) use ($s) {
            $q->whereIn('id', $s);
        })->get();
        return Inertia::render('SearchRes', [
            'posts'=>$posts
        ]);
    }

    public function getPosts(Request $request)
    {
        $search = [];
        $q = Post::query();
        if($request->has('tags'))
        {
            $tagids = $request->get('tags');
            $q->whereHas('tags', function ($t) use ($tagids)
            {
                $t->whereIn('tags.id', $tagids);
            })->get();
            $search = [...$search, 'tags'=>$request->get('tags')];
        }
        if($request->has('search'))
        {
            $q->where('name', 'LIKE', '%'.$request->get('search').'%')->orWhere('content', 'LIKE', '%'.$request->get('search').'%');
            $search = [...$search, 'textSearch'=>$request->get('search')];
        }

        $posts = $q->with('tags')->orderBy('created_at', 'desc')->paginate(15);
        return Inertia::render('SearchRes', [
            'posts'=>$posts,
            'search'=>$search
        ]);
    }

    public function makeTag(Request $request): RedirectResponse
    {
        Tag::create(['name' => $request->name]);
        return redirect('/admin/tags');
    }

    public function newPost(string $tid)
    {
        $tpd = Topic::findOrFail($tid);
        if(Auth::check()){
            if(Auth::user()->hasVerifiedEmail())
            {
                return Inertia::render('MakePost', [
                    'topic_data' => $tpd
                ]);
            }else{
                \Request::session()->flash('alert', [
                    'type'=>'error',
                    'message'=>'You must be verified to post'
                ]);
                return redirect('/');
            }
        }else{
            return redirect('/signin');
        }
    }

    public function createPost(Request $request): RedirectResponse
    {
        //check for tags;
        $tags = $request->tags;

        $newPost = Post::create([
            'name'=>$request->title,
            'topic_id' => $request->topicId,
            'user_id' => Auth::id(),
            'nsfw' => $request->isNSFW,
            'content' => $request->postContent,
        ]);

        if($tags)
        {
            foreach($tags as $tag){
                TagPost::create([
                    'post_id' => $newPost->id,
                    'tag_id' => $tag['id']
                ]);
            }
        }

        return redirect("/post/{$newPost->id}");
    }

    public function updatePost(Request $request): RedirectResponse
    {
        $id = $request->pid;
        $content = $request->PostContent;
        Post::where('id', '=',$id)->update(['content' => $content]);
        return redirect("/post/{$id}");
    }

}
