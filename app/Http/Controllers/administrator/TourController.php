<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TourController extends Controller
{
    public function index($id)
    {
        $tour = DB::table('tour')->find($id);
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();

        $zones = DB::table('zone')->where([
            ['tourId', '=', $id],
            ['isDeleted', '=', false]
        ])->get();
        foreach ($zones as $zone) {
            $booths = DB::table('booth')
                ->join('zone_booth', 'booth.id', '=', 'zone_booth.boothId')
                ->where('zone_booth.zoneId', $zone->id)
                ->select('booth.*', )
                ->get();
            $zone->booths = $booths;
        }

        
        $scene = \App\Models\Scene::find($tour->sceneId);
        $panoramas = [];
        $objects = [];

        if($scene != null){
            $panoramas = DB::table('panorama')->where('sceneId', $scene->id)->get();

            $objects = DB::table('asset')
                ->join('hotspot', 'asset.id', '=', 'hotspot.assetId')
                ->join('panorama', 'panorama.id', '=', 'hotspot.panoramaId')
                ->where([
                    ['panorama.sceneId', '=', $scene->id],
                ])
                ->select('asset.*')
                ->get();
            foreach ($objects as $object) {
                $viewCount = \App\Models\View::where('assetId', $object->id)->count();
                $likeCount = \App\Models\Like::where('assetId', $object->id)->count();
                $commentCount = \App\Models\Comment::where([
                        ['assetId', '=', $object->id],
                    ])->count();
                $object->viewCount = $viewCount;
                $object->likeCount = $likeCount;
                $object->commentCount = $commentCount;
            }
        }

        $likes = \App\Models\Like::where('tourId', $id)->get();
        $views = \App\Models\View::where('tourId', $id)->get();
        $comments = \App\Models\Comment::with('visitor')->where('tourId', $id)->orderBy('created_at', 'DESC')->get();

        return view('administrator.tour.index', [
            'profile' => $profile,
            'tour'=> $tour,
            'scene'=> $scene,
            'panoramas'=> $panoramas,
            'zones'=>$zones,
            'views'=>$views,
            'likes'=>$likes,
            'comments'=>$comments,
            'objects'=>$objects,
        ]);
    }

    public function saveEdit($id, Request $request)
    {
        $name = $request->name;
        $start = $request->start;
        $end = $request->end;
        $image = $request->image;
        $location = $request->location;
        $description = $request->description;
        $image = $request->image;

        $tour = DB::table('tour')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'startTime' => $start,
                'endTime' => $end,
                'image' => $image,
                'location' => $location,
                'description' => $description,
                'image' => $image,
            ]);

        return back();
    }

}
