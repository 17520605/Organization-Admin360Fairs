<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BoothsController extends Controller
{
    
    public function index($id)
    {
        $user = Auth::user();
        $tour = DB::table('tour')->find($id);

        $zones = DB::table('zone_booth')
            ->join('zone', 'zone.id', '=', 'zone_booth.zoneId')
            ->select('zone.*')
            ->where('zone.tourId', $id)
            ->distinct()
            ->orderBy('zone.id', 'asc')
            ->get();
        
        foreach ($zones as $zone) {
            $booth = DB::table('zone_booth')
                ->join('booth', 'booth.id', '=', 'zone_booth.boothId')
                ->select('booth.*')
                ->where('zone_booth.zoneId', '=', $zone->id)
                ->get();

             $zone->booths = $booth;
        }

        $freeBooths = DB::table('booth')
            ->whereRaw(" NOT EXISTS ( SELECT * FROM zone_booth  WHERE  zone_booth.boothId = booth.id )")
            ->get();

        return view('booths.index', ['user' => $user, 'tour'=> $tour, 'zones' => $zones, 'freeBooths'=> $freeBooths]);
    }
}
