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

        $zones = \App\Models\Zone::where([
                ['tourId', '=', $id],
                ['isDeleted', '=', false]
            ])
            ->with('booths')
            ->get();
        
        $scene = \App\Models\Scene::find($tour->sceneId);
        $panoramas = [];
        $hotspots = [];

        if($scene != null){
            $panoramas = \App\Models\Panorama::with('asset')
                ->where([
                    ['sceneId', '=', $scene->id],
                    ['isDeleted', '=', false]
                ])->get();
            $objects = DB::table('asset')
                ->join('hotspot', 'asset.id', '=', 'hotspot.assetId')
                ->join('panorama', 'hotspot.panoramaId', '=', 'panorama.id')
                ->where([
                    ['hotspot.isDeleted', '=', false],
                    ['panorama.sceneId', '=', $scene->id],
                    ['panorama.isDeleted', '=', false],
                    ['asset.id', '!=', null],
                    ['asset.isDeleted', '=', false],
                ])
                ->select('asset.*')
                ->distinct()
                ->get();
            foreach ($objects as $object) {
                $viewCount = \App\Models\View::where('assetId', $object->id)->count();
                $likeCount = \App\Models\Like::where('assetId',  $object->id)->count();
                $commentCount = \App\Models\Comment::where([
                        ['assetId', '=', $object->id],
                        ['isHidden', '=', false],
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
            'user' => $user,
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
                'isPublic' => false,
                'description' => $description,
                'image' => $image,
            ]);

        return back();
    }
    public function publicTour($id, Request $request)
    {
        $tour = DB::table('tour')
            ->where('id', $id)
            ->update([
                'isPublic' => true,
            ]);

        return back();
    }
}
