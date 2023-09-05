<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Inertia\Inertia;

class TopicsController extends Controller
{
    public function show(string $tid)
    {
        return Inertia::render('Topic', [
            'topic_data'=> Topic::findOrFail($tid),
            'posts'=> Post::where('topic_id',$tid)->paginate()
        ]);
    }
}
