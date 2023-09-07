<?php

namespace App\Http\Controllers;

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

    public function createPost(Request $request): RedirectResponse
    {
        $postDetails = $request->validate([
            'title' => ['required'],
            'content' => ['required']
        ]);

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
