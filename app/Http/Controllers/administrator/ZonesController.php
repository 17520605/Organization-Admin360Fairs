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

        $freeBooths = DB::table('booth')
            ->whereRaw(" NOT EXISTS ( SELECT * FROM zone_booth  WHERE  zone_booth.boothId = booth.id )")
            ->get();

        return view('administrator.zones.index', ['profile' => $profile, 'tour'=> $tour, 'zones'=> $zones, 'freeBooths' => $freeBooths ]);
    }

    public function zone ($id, $zoneId)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $zone = \App\Models\Zone::find($zoneId);
        $scene = \App\Models\Scene::find($zone->sceneId);
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

        $booths = \App\Models\Booth::with('owner')
            ->whereHas('zone_booths', function ($q) use($zoneId){
                $q->where('zoneId', '=', $zoneId);
            })
            ->get();

        $freeBooths = DB::table('booth')
            ->whereRaw(" NOT EXISTS ( SELECT * FROM zone_booth  WHERE  zone_booth.boothId = booth.id )")
            ->get();

        return view('administrator.zones.zone', [
            'profile' => $profile,
            'tour'=> $tour,
            'panoramas'=> $panoramas, 
            'scene' => $scene,
            'zone'=>$zone,
            'booths' => $booths,
            'freeBooths' => $freeBooths,
            'objects'=>$objects,
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
