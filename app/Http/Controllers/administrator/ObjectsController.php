<?php

namespace App\Http\Controllers\administrator;

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

        return view('administrator.objects.index', [
            'profile' => $profile, 
            'tour'=>$tour,
            'objects'=>$objects,
        ]);
    }

    public function dashboard ($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        return view('administrator.objects.dashboard', ['profile' => $profile, 'tour'=>$tour]);
    }

    public function object($id, $objectId, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $object = \App\Models\TObject::find($objectId);
        $views = \App\Models\View::with('visitor')->where('objectId', $objectId)->get();
        $interests = \App\Models\Interest::with('visitor')->where('objectId', $objectId)->get();

        return view('administrator.objects.object', [
            'profile' => $profile, 
            'tour'=>$tour,
            'object' => $object,
            'views' => $views,
            'interests' => $interests,
        ]);
    }

    public function images ($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $images = DB::table('object')->where([
            ['tourId','=', $id],
            ['type','=', 'image'],
        ])->get();

        return view('administrator.objects.images', ['profile' => $profile, 'tour'=>$tour, 'images' => $images]);
    }

    public function videos ($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $videos = DB::table('object')->where([
            ['tourId','=', $id],
            ['type','=', 'video'],
        ])->get();

        return view('administrator.objects.videos', ['profile' => $profile , 'tour'=>$tour, 'videos' => $videos]);
    }

    public function audios ($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
 
        $audios = DB::table('object')->where([
            ['tourId','=', $id],
            ['type','=', 'audio'],
        ])->get();
        return view('administrator.objects.audios', ['profile' => $profile, 'tour'=>$tour, 'audios' => $audios]);
    }

    public function models ($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $models = DB::table('object')->where([
            ['tourId','=', $id],
            ['type','=', 'model'],
        ])->get();
        return view('administrator.objects.models', ['profile' => $profile, 'tour'=>$tour,'models' => $models]);
    }

    public function documents ($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $documents = DB::table('object')->where([
            ['tourId','=', $id],
            ['type','=', 'document'],
        ])->get();
        return view('administrator.objects.documents', ['profile' => $profile, 'tour'=>$tour ,'documents' => $documents]);
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
