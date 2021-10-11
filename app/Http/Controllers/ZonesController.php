<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ZonesController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();
        $tour = DB::table('tour')->find($id);

        $zones = DB::table('zone')->where('tourId', $id)->get();
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

        return view('zones.index', ['user' => $user, 'tour'=> $tour, 'zones'=> $zones, 'freeBooths' => $freeBooths ]);
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

    public function zone ($id, $zoneId)
    {
        
        $tour = DB::table('tour')->find($id);
        $zone = \App\Models\Zone::find($zoneId);
        $overview = \App\Models\Panorama::find($zone->overviewId);
        $objects = \App\Models\Zone_Object::with('object')
            ->select('object.*')
            ->where('zone.id', '=', $zoneId)
            ->get();
        $booths = \App\Models\Zone_Booth::with('booth')
            ->select('booth.*')
            ->where('zone.id', '=', $zoneId)
            ->get();
        
        return view('zones.zone', ['user' => $user, 'tour'=> $tour, 'overview'=> $overview, 'objects' => $objects, 'booths' => $booths]);
    }
}
