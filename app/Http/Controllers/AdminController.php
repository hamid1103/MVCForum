<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
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
            return Inertia::render('Panels/AdminHome');
        }else{
            Request::session()->flash('alert', [
                'type'=>'error',
                'message'=>'You are not authorized to access this url'
            ]);
            return redirect('/');
        }
    }

    public function roles()
    {
        $Users= User::paginate(30);
        return Inertia::render('Panels/Roles', ['users'=>$Users]);
    }
    public function tags()
    {
        $tags = Tag::all();
        return Inertia::render('Panels/Tags', ['tags'=>$tags]);
    }

    public function SiteSettings()
    {
        if(Storage::exists('public/frontpage.doca')){
            $frontpage = Storage::read('public/frontpage.doca');
        }else{
            $frontpage = 404;
        }
        return Inertia::render('Panels/SiteSettings', ['frontpage'=>$frontpage]);
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
