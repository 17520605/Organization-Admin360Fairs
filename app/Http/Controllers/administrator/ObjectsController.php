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
        $assets = \App\Models\Asset::where([
                ['tourId','=', $id],
            ])
            ->orderBy('updated_at', "DESC")
            ->get();

        $types = DB::table('asset')
            ->where('tourId', $tour->id)
            ->select('type', DB::raw('sum(size) as size'),  DB::raw('count(asset.id) as count'))
            ->groupBy('type')
            ->get();
    
        return view('administrator.objects.dashboard', [
            'profile' => $profile, 
            'tour'=> $tour,
            'assets'=> $assets,
            'types' => $types
        ]);
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

    public function saveCreateAsset($id, Request $request)
    {  
        $tourId = $id;
        $boothId = $request->input('boothId');
        $type = $request->input('type');
        $source = $request->input('source');
        $file = $request->file;
        $url = $request->input('url');

        $asset = new \App\Models\Asset();
        $asset->tourId = $tourId;
        $asset->boothId = $boothId;
        $asset->type = $type;
        $asset->source = $source;
        $asset->url = $url;

        if($source == 'local'){
            $cloud = $this->uploadFile1($request->file('file'));
            $asset->name = $request->file('file')->getClientOriginalName();
            $asset->format = $request->file('file')->getClientOriginalExtension();
            $asset->url = $cloud->url;
            $asset->size = $cloud->bytes;
        }
        else
        if($source == 'link'){
            if(str_starts_with($asset->url, 'https://youtu.be/')){
                $asset->source = 'youtube';
            }
        }
        
        $asset->save();

        return $asset;
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

        $objectId = DB::table('object')->insertGetId([
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
