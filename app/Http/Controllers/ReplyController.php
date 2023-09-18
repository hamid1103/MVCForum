<?php

namespace App\Http\Controllers;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReplyController extends Controller
{
    public function CreateReply(Request $request)
    {
        $post_id = $request->post_id;
        //$page = $request->page;
        if(Auth::check()){
            if(Auth::user()->hasVerifiedEmail())
            {
                $newReply = Reply::create([
                    'user_id' =>Auth::user()->id,
                    'post_id' => $post_id,
                    'context' => $request->postContent,
                    'score' => 0
                ]);
                return redirect("/post/{$post_id}");
            }
            else {
                $request->session()->flash('alert', [
                    'type'=>'error',
                    'message'=>'You must be verified to reply'
                ]);
                return redirect('/');
            }
        }else{
            $request->session()->flash('alert', [
                'type'=>'error',
                'message'=>'You must be logged in to reply'
            ]);
            return redirect('/signin');
        }
    }
}
