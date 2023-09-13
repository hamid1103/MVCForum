<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use App\Models\UserSettings;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function show(string $tid)
    {

        $user = Auth::user();
        $settings = UserSettings::where('user_id', $user->id)->get();
        $hideNSFW = $settings[0]->hideNSFW;

        if ($hideNSFW === 1){
            $posts = Post::where([
                ['topic_id','=', $tid],
                ['nsfw','=', '0'],
            ])->paginate(15);
        }else{
            $posts = Post::where('topic_id', $tid)->paginate(15);
        }

        $tpd = Topic::findOrFail($tid);

        return Inertia::render('Topic', [
            'topic_data' => $tpd,
            'posts' => $posts
        ]);
    }


}
