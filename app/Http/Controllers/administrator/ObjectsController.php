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
        $tour = DB::table('tour')->find($id);
        return view('tour.index', ['user' => Auth::user(), 'tour'=>$tour]);
    }

    public function images ($id, Request $request)
    {
        $tour = DB::table('tour')->find($id);

        $images = DB::table('object')->where([
            ['tourId','=', $id],
            ['type','=', 'image'],
        ])->get();

        return view('objects.images', ['user' => Auth::user(), 'tour'=>$tour, 'images' => $images]);
    }

    public function videos ($id, Request $request)
    {
        $tour = DB::table('tour')->find($id);

        $videos = DB::table('object')->where([
            ['tourId','=', $id],
            ['type','=', 'video'],
        ])->get();

        return view('objects.videos', ['user' => Auth::user(), 'tour'=>$tour, 'videos' => $videos]);
    }

    public function audios ($id, Request $request)
    {
        $tour = DB::table('tour')->find($id);
        $audios = DB::table('object')->where([
            ['tourId','=', $id],
            ['type','=', 'audio'],
        ])->get();
        return view('objects.audios', ['user' => Auth::user(), 'tour'=>$tour, 'audios' => $audios]);
    }

    public function models ($id, Request $request)
    {
        $tour = DB::table('tour')->find($id);
        $models = DB::table('object')->where([
            ['tourId','=', $id],
            ['type','=', 'model'],
        ])->get();
        return view('objects.models', ['user' => Auth::user(), 'tour'=>$tour,'models' => $models]);
    }

    public function documents ($id, Request $request)
    {
        $tour = DB::table('tour')->find($id);
        return view('objects.documents', ['user' => Auth::user(), 'tour'=>$tour]);
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
