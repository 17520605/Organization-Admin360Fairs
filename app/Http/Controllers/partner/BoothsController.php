<?php

namespace App\Http\Controllers\partner;

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

        $booths = \App\Models\Booth::with('owner')->where('ownerId', $profile->id)->get();

        return view('partner.booths.index', [
            'profile' => $profile, 
            'tour'=> $tour, 
            'booths'=> $booths,
        ]);
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

        $boothObjects = \App\Models\TObject::whereHas('booth_objects', function($q) use ($boothId)
            {
                $q->where('boothId', '=', $boothId);
            })
            ->where([
                ['tourId','=', $id],
                ['ownerId', '=', $profile->id]
            ])
            ->get();
        
        $otherObjects = \App\Models\TObject::where([
                ['tourId','=', $id],
                ['ownerId', '=', $profile->id]
            ])
            ->doesntHave('booth_objects')
            ->orWhereHas('booth_objects', function($q) use ($boothId)
            {
                $q->where('boothId', '!=', $boothId)->orWhere('boothId', null);
            })
            ->where([
                ['tourId','=', $id],
                ['ownerId', '=', $profile->id]
            ])
            ->get();

        $types = DB::table('object')
            ->join('booth_object', 'object.id', '=', 'booth_object.objectId')
            ->where('booth_object.boothId', $boothId)
            ->select('type', DB::raw('sum(size) as size'),  DB::raw('count(object.id) as count'))
            ->groupBy('type')
            ->get();
        
        $views = \App\Models\View::with('visitor')->where('boothId', $boothId)->get();
        $interests = \App\Models\Interest::with('visitor')->where('boothId', $boothId)->get();

        return view('partner.booths.booth', [
            'profile' => $profile, 
            'tour'=> $tour, 
            'booth' => $booth,
            'panoramas' => $panoramas,
            'scene' => $scene,
            'boothObjects' => $boothObjects,
            'otherObjects' => $otherObjects,
            'types' => $types,
            'views' => $views,
            'interests' => $interests
        ]);

    } 

    public function saveEdit($id, Request $request)
    {
        $tour = DB::table('tour')->find($id);

        $boothId = $request->boothId;
        $name = $request->name;
        $description = $request->description;
        $logo = $request->logo;

        $booth = \App\Models\Booth::find($boothId); 
        $booth->name = $name;
        $booth->description =  $description;
        $booth->logo =  $logo;
        $booth->save();

        return back();
    }

    public function saveAddObjects($id, Request $request)
    {
        $objectIds = $request->objectIds;
        $boothId = $request->boothId;

        foreach ($objectIds as $objectId) {
            $booth_object = new \App\Models\Booth_Object();
            $booth_object->boothId = $boothId;
            $booth_object->objectId = $objectId;
            $booth_object->save();
        }

        return back();
    }
}
