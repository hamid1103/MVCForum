<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class FileController extends Controller
{
    //Formdata
        // image: binary
    public function PostImageFromUpload(Request $request)
    {
        $url = $request->user()->id."/";

        if(!Storage::put("public/{$url}{$request->filename}", file_get_contents($request->file))){
            return response()->json([
                'success'=>0,
                'msg'=>'bruh'
            ]);
        }else{
            return response()->json([
                'success'=>1,
                'file'=>Storage::url("{$url}{$request->filename}")
            ]);
        }
    }

    public function PostImageFromUrl(Request $request)
    {

    }

}
