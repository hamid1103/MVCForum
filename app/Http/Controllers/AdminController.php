<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

class AdminController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        if (Gate::allows('administrate', $user)){
            return Inertia::render('Admin/AdminHomePanel', ['frontpage'=>Storage::read('public/frontpage.doca')]);
        }else{
            Request::session()->flash('alert', [
                'type'=>'error',
                'message'=>'You are not authorized to access this url'
            ]);
            return redirect('/');
        }
    }

    public function saveFrontPageContent(Request $request)
    {
        if(!Gate::allows('update-site'))
        {
            $request->session()->flash('alert', [
                'type'=>'error',
                'message'=>'You do not have permission to edit the front page'
            ]);
            return error('You do not have permission to edit the front page');
        }
        if(!Storage::put('public/frontpage.doca', Json::encode($request->PostContent))){
            $request->session()->flash('alert', [
                'type'=>'error',
                'message'=>'File could not be written'
            ]);
        }else{
            session()->flash('alert', [
                'type'=>'success',
                'message'=>'Front page content has been saved'
            ]);
        }
    }

}
