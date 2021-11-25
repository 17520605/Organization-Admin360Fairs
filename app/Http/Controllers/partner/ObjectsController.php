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

    public function index ($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $booth = \App\Models\Booth::with('owner')->find($id);
        $boothObjects = \App\Models\TObject::whereHas('booth_objects', function($q) use ($id){
                $q->where('boothId', '=', $id);
            })
            ->where([
                ['tourId','=', $id],
                ['ownerId', '=', $profile->id]
            ])
            ->get();
        
        $otherObjects = \App\Models\TObject::where([
                ['tourId','=', $id],
                ['ownerId', '=', $profile->id]
            ])
            ->doesntHave('booth_objects')
            ->orWhereHas('booth_objects', function($q) use ($id)
            {
                $q->where('boothId', '!=', $id)->orWhere('boothId', null);
            })
            ->where([
                ['tourId','=', $id],
                ['ownerId', '=', $profile->id]
            ])
            ->get();

        $types = DB::table('object')
            ->join('booth_object', 'object.id', '=', 'booth_object.objectId')
            ->where('booth_object.boothId', $id)
            ->select('type', DB::raw('sum(size) as size'),  DB::raw('count(object.id) as count'))
            ->groupBy('type')
            ->get();
            
        return view('partner.objects.index', [
            'profile' => $profile, 
            'booth' => $booth,
            'boothObjects' => $boothObjects,
            'otherObjects' => $otherObjects,
            'types' => $types,
        ]);
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
        
        $boothId = $request->boothId;
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

        if($boothId != null){
            $booth_object = new \App\Models\Booth_Object();
            $booth_object->boothId = $boothId;
            $booth_object->objectId = $objectId;
            $booth_object->save();
        }

        return back();
    }
}
