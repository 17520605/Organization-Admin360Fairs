<?php

namespace App\Http\Controllers\partner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ObjectsController extends Controller
{
    public function index($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $objects = \App\Models\TObject::where([
            ['tourId','=', $id]
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
        $type = $request->type;
        $source = $request->source;
        $name = $request->name;
        $description = $request->description;
        $url = $request->url;
        $format = $request->format;
        $width = $request->width;
        $height = $request->height;
        $size = $request->size;

        $rs = DB::table('object')->insert([
            'tourId'=> $id,
            'type' => $request->type,
            'source' => $request->source,
            'name' => $request->name,
            'description' => $request->description,
            'url' => $request->url,
            'format' => $request->format,
            'width' => $request->width,
            'height' => $request->height,
            'size' => $request->size
        ]);

        return back();
    }
}
