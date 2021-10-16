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

        $zones = DB::table('zone')->where('tourId', $id)->get();
        foreach ($zones as $zone) {
            $booths = DB::table('booth')
                ->join('zone_booth', 'booth.id', '=', 'zone_booth.boothId')
                ->where('zone_booth.zoneId', $zone->id)
                ->select('booth.*', )
                ->get();
            $zone->booths = $booths;
        }

        $overview = \App\Models\Panorama::find($tour->overviewId);

        return view('administrator.tour.index', [
            'profile' => $profile,
            'tour'=> $tour,
            'overview'=> $overview,
            'zones'=>$zones
        ]);
    }

    public function saveEdit($id, Request $request)
    {
        $name = $request->name;
        $start = $request->start;
        $end = $request->end;
        $location = $request->location;
        $description = $request->description;
        $image = $request->image;

        $tour = DB::table('tour')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'startTime' => $start,
                'endTime' => $end,
                'location' => $location,
                'description' => $description,
                'image' => $image,
            ]);

        return back();
    }

}
