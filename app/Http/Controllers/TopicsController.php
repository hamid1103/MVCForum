<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Topic;
use App\Models\UserSettings;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    public function getCats(string $s = '')
    {
        if($s == '')
        {
            return Category::all();
        }else{
            return Category::where('name', 'LIKE', '%'.$s.'%')->get();
        }
    }
    public function show(string $tid)
    {
        $user = Auth::user();
        if($user !== null){
            $settings = UserSettings::where('user_id', $user->id)->get();
            $hideNSFW = $settings[0]->hideNSFW;

            if ($hideNSFW === 1){
                $posts = Post::where([
                    ['topic_id','=', $tid],
                    ['nsfw','=', '0'],
                ])->with('tags')
                    ->paginate(15);
            }else{
                $posts = Post::where('topic_id', $tid)->with('tags')->paginate(15);
            }
        }else{
            $posts = Post::where([
                ['topic_id','=', $tid],
                ['nsfw','=', '0'],
            ])->with('tags')->paginate(15);
        }

        $tpd = Topic::findOrFail($tid);

        return Inertia::render('Topic', [
            'topic_data' => $tpd,
            'posts' => $posts
        ]);
    }

    public function newCategory(Request $request)
    {
        if(Gate::allows('update-site', $request->user()))
        {
            Category::create(['name'=>$request->name]);
            $request->session()->flash('alert', [
                'type'=>'success',
                'message'=>'Created New Category'
            ]);
        }else{
            $request->session()->flash('alert', [
                'type'=>'error',
                'message'=>'You do not have permission to create categories.'
            ]);
        }
    }

    public function newTopic(Request $request)
    {
        if(Gate::allows('update-site', $request->user()))
        {
            Topic::create([
                'name'=>$request->name,
                'category_id' => $request->category,
                'description' => $request->description,
                'nsfw'=>$request->isNSFW]);

            $request->session()->flash('alert', [
                'type'=>'success',
                'message'=>'Created New Topic'
            ]);
        }else{
            $request->session()->flash('alert', [
                'type'=>'error',
                'message'=>'You do not have permission to create topics.'
            ]);
        }
    }

}
