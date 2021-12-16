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
            $panoramas = DB::table('panorama')->where('sceneId', $scene->id)->get();
            $hotspots = \App\Models\Hotspot::where([
                    ['isDeleted', '=', false],
                    ['assetId', '!=', null],
                ])
                ->whereHas('panorama', function ($q) use($scene){
                    $q->where('sceneId', '=', $scene->id);
                })
                ->get();
            
            foreach ($hotspots as $hotspot) {
                $asset = \App\Models\Asset::find($hotspot->assetId);
                $viewCount = \App\Models\View::where('assetId', $hotspot->assetId)->count();
                $likeCount = \App\Models\Like::where('assetId',  $hotspot->assetId)->count();
                $commentCount = \App\Models\Comment::where([
                        ['assetId', '=', $hotspot->assetId],
                        ['isHidden', '=', false],
                    ])->count();
                $hotspot->viewCount = $viewCount;
                $hotspot->likeCount = $likeCount;
                $hotspot->commentCount = $commentCount;
                $hotspot->asset = $asset;
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
            'hotspots'=>$hotspots,
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
