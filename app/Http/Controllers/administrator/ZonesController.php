<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ZonesController extends Controller
{
    public function index($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $zones = \App\Models\Zone::with('booths')
            ->where([
                ['tourId', '=', $id],
                ['isDeleted', '=', false]
            ])->get();     

        $booths = \App\Models\Booth::where([
            ['tourId', '=', $id],
            ['zoneId', '=', null]
        ]);

        return view('administrator.zones.index', [
            'profile' => $profile, 
            'tour'=> $tour,
            'zones'=> $zones, 
            'booths' => $booths 
        ]);
    }

    public function zone ($id, $zoneId)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $zone = \App\Models\Zone::find($zoneId);
        $scene = \App\Models\Scene::find($zone->sceneId);
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

        $booths = \App\Models\Booth::with('owner')
            ->where([
                ['zoneId', '=', $zone->id],
                ['isDeleted', '=', false],
            ])
            ->get();

        $freeBooths = $booths = \App\Models\Booth::with('owner')
            ->where([
                ['zoneId', '=', null],
                ['tourId', '=', $tour->id],
                ['isDeleted', '=', false],
            ])
            ->get();

        return view('administrator.zones.zone', [
            'profile' => $profile,
            'tour'=> $tour,
            'panoramas'=> $panoramas, 
            'scene' => $scene,
            'zone'=>$zone,
            'booths' => $booths,
            'freeBooths' => $freeBooths,
            'hotspots'=>$hotspots,
        ]);
    }

    public function saveCreate($id, Request $request)
    {

        $name = $request->name;
        $boothIds = $request->boothIds;

        $zoneId = DB::table('zone')->insertGetId([
            'tourId' => $id,
            'name'=> $name
        ]);

        if(isset($boothIds)){
            foreach ($boothIds as $boothId) {
                DB::table('zone_booth')->insert([
                    'zoneId' => $zoneId,
                    'boothId'=> $boothId
                ]);
            }
        }

        return back();
    }

    public function saveEdit($id, Request $request)
    {
        $zoneId = $request->id;
        $name = $request->name;
        $boothIds = $request->boothIds;
        // delete relation
        \App\Models\Zone_Booth::where('zoneId', $zoneId)->delete();

        // re create relation
        if(isset($boothIds)){
            foreach ($boothIds as $boothId) {
                DB::table('zone_booth')->insert([
                    'zoneId' => $zoneId,
                    'boothId'=> $boothId
                ]);
            }
        }
        return back();
    }

    public function saveAddBooths($id, $zoneId, Request $request)
    {
        $boothIds = $request->boothIds;
        foreach ($boothIds as $boothId) {
            $zone_booth = new \App\Models\Zone_Booth();
            $zone_booth->zoneId = $zoneId;
            $zone_booth->boothId = $boothId;
            $zone_booth->save();
        }
        return back();
    }
    public function saveDelete($id, $zoneId, Request $request)
    {
        $zone = \App\Models\Zone::find($zoneId);
        $zone->isDeleted = true ;
        $zone->save();

        $zone_booths = \App\Models\Zone_Booth::where('zoneId', $zoneId)->delete();

        return true;
    }
}
