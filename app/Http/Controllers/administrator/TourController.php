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
        // $tour = DB::table('tour')->find($id);
        // return view('tour.index', ['user' => Auth::user(), 'tour'=>$tour]);

        $tour = DB::table('tour')->find($id);
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();

        $zones = \App\Models\Zone::get();

        $overview = \App\Models\Panorama::find($tour->overviewId);

        return view('administrator.tour.index', [
            'profile' => $profile,
            'tour'=> $tour,
            'overview'=> $overview, 
            'zones'=>$zones
        ]);
    }

    public function edit($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        
        return view('administrator.tour.edit', ['profile' => $profile,'tour' => $tour]);
    }

    public function saveEdit($id, Request $request)
    {
        $name = $request->name;
        $start_at = $request->start_at;
        $end_at = $request->end_at;
        $location = $request->location;
        $description = $request->description;
        $image = $request->image;

        $tour = DB::table('tour')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'startTime' => $start_at,
                'endTime' => $end_at,
                'location' => $location,
                'description' => $description,
                'image' => $image,
            ]);

        return redirect('administrator/tours/'.$id.'/tour');
    }

}
