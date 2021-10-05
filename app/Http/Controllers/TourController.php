<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TourController extends Controller
{
    public function index($id)
    {

        $tour = DB::table('tour')->find($id);
        return view('tour.index', ['user' => Auth::user(), 'tour'=>$tour]);
    }

    public function edit($id)
    {
        $tour = DB::table('tour')->find($id);
        return view('tour.edit', ['user' => Auth::user(),'tour' => $tour]);
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

        return redirect('/tours/'.$id.'/tour');
    }

    
}
