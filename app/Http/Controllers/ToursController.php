<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ToursController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tours = DB::table('tour')->where('organizerId', '=', $user->id)->get();

        if(count($tours) == 0){
            $tour = DB::table('tour')->insert([
                'name' => 'First Tour',
                'organizerId' => $user->id
            ]);

            $tours = DB::table('tour')->where('organizerId', '=', $user->id)->get();
        }

        return view('tours.index', ['user' => $user, 'tours'=>$tours]);
    }

    public function saveCreate(Request $request)
    {
        $name = $request->name;
        $start_at = $request->start_at;
        $end_at = $request->end_at;
        $type = $request->type;
        $location = $request->location;
        $description = $request->description;

        $tour = DB::table('tour')
            ->insert([
                'name' => $name,
                'startTime' => $start_at,
                'endTime' => $end_at,
                'location' => $location,
                'description' => $description,
                'organizerId' => Auth::id()
            ]);

        return redirect('/tours');
    }
}
