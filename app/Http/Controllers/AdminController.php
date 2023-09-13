<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        if (Gate::allows('administrate', $user)){
            return Inertia::render('Admin/AdminHomePanel');
        }else{
            \Request::session()->flash('alert', [
                'type'=>'error',
                'message'=>'You are not authorized to access this url'
            ]);
            return redirect('/');
        }
    }



}
