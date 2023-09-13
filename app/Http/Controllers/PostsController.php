<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PostsController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return Inertia::render('ViewPost', [
            'post' => $post
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

}
