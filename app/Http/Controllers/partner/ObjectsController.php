<?php

namespace App\Http\Controllers\partner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use \stdClass;

class ObjectsController extends Controller
{
    public function index($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $objects = \App\Models\TObject::where([
            ['tourId','=', $id],
            ['ownerId', '=', $profile->id]
        ])->get();

        return view('partner.objects.index', [
            'profile' => $profile, 
            'tour'=>$tour,
            'objects'=>$objects,
        ]);
    }
    
    public function dashboard ($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        return view('partner.objects.dashboard', ['profile' => $profile, 'tour'=>$tour]);
    }
    
    public function object($id, $objectId, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $object = \App\Models\TObject::find($objectId);
        $views = \App\Models\View::with('visitor')->where('objectId', $objectId)->get();
        $interests = \App\Models\Interest::with('visitor')->where('objectId', $objectId)->get();

        return view('partner.objects.object', [
            'profile' => $profile, 
            'tour'=>$tour,
            'object' => $object,
            'views' => $views,
            'interests' => $interests,
        ]);
    }
    
    public function saveCreate($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        
        $type = $request->type;
        $source = $request->source;
        $name = $request->name;
        $description = $request->description;
        $file = $request->file('file');
        $url = $request->url;
        $format = null;
        $size = null;
        $content = null;

        if($source == 'local'){
            if($request->hasFile('file')){
                $res = cloudinary()->upload($file->getRealPath(), [
                    'resource_type' => 'auto'
                ])->getResponse();
                $resObj = json_decode(json_encode($res));

                $url = $resObj->url;
                $format = $resObj->format;
                $size = $resObj->bytes;

                $content = new \stdClass();
                $content->width = $resObj->width;
                $content->height = $resObj->height;
            }
        }
        else
        if($source == 'link'){
            if(str_starts_with($url, 'https://www.youtube.com/')){
                $source = 'youtube';
            }
        }

        $rs = DB::table('object')->insert([
            'tourId'=> $id,
            'ownerId'=> $profile->id,
            'type' => $type,
            'source' => $source,
            'name' => $name,
            'description' => $description,
            'url' => $url,
            'format' => $format,
            'size' => $size,
            'content' => $content != null ? json_encode($content) : null
        ]);

        return back();
    }
}
