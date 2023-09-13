<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserModelController extends Controller
{
    public function show($id)
    {

    }

    public function edit(){
        $user = Auth::user();
        $userSettings = UserSettings::where('user_id', Auth::id())->get();
        return Inertia::render('UserSettings',['user'=>$user,'settings'=>$userSettings]);
    }

    public function updateBio(Request $request)
    {
        $user = $request->user();
        $bio = $request->bio;
        User::findOrFail($user->id)->update([
            'bio'=>$bio
        ]);
        $request->session()->flash('alert', [
            'type'=>'success',
            'message'=>'Updated Bio'
        ]);
        return redirect('/settings');
    }

    public function updateStatus(Request $request)
    {
        $user = $request->user();
        $status = $request->status;
        User::findOrFail($user->id)->update([
            'status'=>$status
        ]);
        $request->session()->flash('alert', [
            'type'=>'success',
            'message'=>'Updated Status'
        ]);
        return redirect('/settings');

    }

    public function updateSettings(Request $request)
    {
        $settings = UserSettings::where('user_id','=',$request->user()->id)->firstOrFail();
        $settings->update([
            'hideNSFW'=> $request->hideNSFW
        ]);
        $request->session()->flash('alert', [
            'type'=>'success',
            'message'=>'Updated Settings'
        ]);
        return redirect('/settings');
    }

}
