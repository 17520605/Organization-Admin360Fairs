<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Cloudinary\Uploader;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StorageController extends Controller
{
    public function upload(Request $request)
    {
        if($request->hasFile('file')){
            $rs = cloudinary()->upload($request->file('file')->getRealPath(), [
                'resource_type' => 'auto'
            ])->getSecurePath();
            return response($rs);
        }
        return response();
    }
}
