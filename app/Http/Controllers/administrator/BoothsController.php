<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BoothsController extends Controller
{
    
    public function index($id)
    {
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();

        $tour = DB::table('tour')->find($id);

        $zones = \App\Models\Zone::get();

        $groups = DB::table('zone_booth')
            ->join('zone', 'zone.id', '=', 'zone_booth.zoneId')
            ->select('zone.*')
            ->where('zone.tourId', $id)
            ->distinct()
            ->orderBy('zone.id', 'asc')
            ->get();
        
        foreach ($groups as $group) {
            $booth = DB::table('zone_booth')
                ->join('booth', 'booth.id', '=', 'zone_booth.boothId')
                ->select('booth.*')
                ->where('zone_booth.zoneId', '=', $group->id)
                ->get();

            $group->booths = $booth;
        }

        $freeBooths = DB::table('booth')
            ->whereRaw(" NOT EXISTS ( SELECT * FROM zone_booth  WHERE  zone_booth.boothId = booth.id )")
            ->get();

        return view('booths.index', ['profile' => $profile, 'tour'=> $tour, 'zones' => $zones, 'groups' => $groups, 'freeBooths'=> $freeBooths]);
    }

    public function saveCreate($id, Request $request)
    {
        $tour = DB::table('tour')->find($id);

        $name = $request->name;
        $zoneId = $request->zoneId;

        $booth = new \App\Models\Booth(); 
        $booth->name =  $name;
        $booth->tourId =  $id;
        $booth->save();

        $zone_booth = new \App\Models\Zone_Booth();
        $zone_booth->zoneId =  $zoneId;
        $zone_booth->boothId =  $booth->id;
        $zone_booth->save();

        return back();
    }
}
