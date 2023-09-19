<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Topic;
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
        $replies = Reply::where('post_id', '=', $post->id)->with('user')->paginate(15);

        //getReplies (With optional pageination value)

        return Inertia::render('ViewPost', [
            'post' => $post,
            'replies'=>$replies
        ]);
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
        $newPost = Post::create([
            'name'=>$request->title,
            'topic_id' => $request->topicId,
            'user_id' => Auth::id(),
            'nsfw' => $request->isNSFW,
            'content' => $request->postContent
        ]);

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
