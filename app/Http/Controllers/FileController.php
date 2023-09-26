<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //Formdata
        // image: binary
    public function PostImageFromUpload(Request $request)
    {
        $url = $request->user()->id."/".date('m-d-Y_hia').".".$request->extension;
        if(!Storage::put("public/{$url}", Json::encode($request->PostContent))){
        }else{
            return Json::encode([
                'success'=>1,
                'file'=>['url'=>$url]
            ]);
        }
    }

    public function PostImageFromUrl(Request $request)
    {

    }

}
