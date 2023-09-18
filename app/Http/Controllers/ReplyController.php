<?php

namespace App\Http\Controllers;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReplyController extends Controller
{
    public function CreateReply(Request $request)
    {
        $post_id = $request->post_id;
        if(Auth::check()){
            if(Auth::user()->hasVerifiedEmail())
            {
                Reply::create([
                    'user_id' =>
                ]);
            }
            else {
                \Request::session()->flash('alert', [
                    'type'=>'error',
                    'message'=>'You must be verified to reply'
                ]);
                return redirect('/');
            }
        }else{
            \Request::session()->flash('alert', [
                'type'=>'error',
                'message'=>'You must be logged in to reply'
            ]);
            return redirect('/signin');
        }
    }
}
