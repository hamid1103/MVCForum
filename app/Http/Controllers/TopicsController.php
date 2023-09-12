<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function show(string $tid)
    {
        $tpd = Topic::findOrFail($tid);

        return Inertia::render('Topic', [
            'topic_data' => $tpd,
            'posts' => Post::where('topic_id', $tid)->paginate(15)
        ]);
    }

    public function newPost(string $tid)
    {
        $user = Auth::user();
        $tpd = Topic::findOrFail($tid);

        if(Auth::check()){
            if($user->hasVerifiedEmail())
            {
                return Inertia::render('MakePost', [
                    'topic_data' => $tpd
                ]);
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/signin');
        }

    }

}
