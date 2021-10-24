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

        $zones = \App\Models\Zone::where('isDeleted', false)->get();

        $groups = \App\Models\Zone::where('isDeleted', false)->get();
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

        return view('administrator.booths.index', ['profile' => $profile, 'tour'=> $tour, 'zones' => $zones, 'groups' => $groups, 'freeBooths'=> $freeBooths]);
    }

    public function changeLogo($id, $boothId, Request $request)
    {
        $logo = $request->logo;
        $booth = \App\Models\Booth::find($boothId);
        $booth->logo =  $logo;
        $booth->save();
        return true;
    }

    public function booth($id, $boothId, Request $request)
    {
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();
        $tour = DB::table('tour')->find($id);

        $booth = \App\Models\Booth::with('owner')->find($boothId);
        $scene = DB::table('scene')->find($booth->sceneId);
        $panoramas = [];
        if($scene != null){
            $panoramas = DB::table('panorama')->where('sceneId', $scene->id)->get();
        }

        $objects = DB::table('object')
            ->join('booth_object', 'booth_object.objectId', '=', 'object.Id')
            ->where('booth_object.boothId', '=', $boothId)
            ->select('object.*')
            ->get();

        $types = DB::table('object')
            ->join('booth_object', 'object.id', '=', 'booth_object.objectId')
            ->where('booth_object.boothId', $boothId)
            ->select('type', DB::raw('sum(size) as size'),  DB::raw('count(object.id) as count'))
            ->groupBy('type')
            ->get();
        
        $views = \App\Models\View::with('visitor')->where('boothId', $boothId)->get();

        return view('administrator.booths.booth', [
            'profile' => $profile, 
            'tour'=> $tour, 
            'booth' => $booth,
            'panoramas' => $panoramas,
            'scene' => $scene,
            'objects' => $objects,
            'types' => $types,
            'views' => $views
        ]);

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

        if(isset($zoneId)){
            $zone_booth = new \App\Models\Zone_Booth();
            $zone_booth->zoneId =  $zoneId;
            $zone_booth->boothId =  $booth->id;
            $zone_booth->save();
        }

        return back();
    }

    public function saveEdit($id, Request $request)
    {
        $tour = DB::table('tour')->find($id);

        $boothId = $request->id;
        $name = $request->name;
        $zoneId = $request->zoneId;

        $booth = \App\Models\Booth::find($boothId); 
        $booth->name =  $name;
        $booth->save();

        $zone_booth = \App\Models\Zone_Booth::where('boothId', $boothId)->first();
        
        if(isset($zoneId) && isset($zone_booth)){ // booth chuyen tu zone nay sang zone khac
            $zone_booth->zoneId =  $zoneId;
            $zone_booth->save();
        }
        else
        if(isset($zoneId) && !isset($zone_booth)){ //booth chuyen vao zone
            $zone_booth = new \App\Models\Zone_Booth();
            $zone_booth->boothId = $boothId;
            $zone_booth->zoneId = $zoneId;
            $zone_booth->save();
        }
        else
        if(isset($zone_booth)){ //booth ra khoi zone
            $zone_booth ->delete();
        }

        return back();
    }

    public function saveDelete($id, $boothId, Request $request)
    {
        $booth = \App\Models\Booth::find($boothId);
        $booth->delete();
        return true;
    }
}
