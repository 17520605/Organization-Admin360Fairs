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
        $tours = DB::table('360tool_tour')->where('user_id', '=', $user->id)->get();

        if(count($tours) == 0){
            $tour = DB::table('360tool_tour')->insert([
                'name' => 'First Tour',
                'user_id' => $user->id
            ]);

            $tours = DB::table('360tool_tour')->where('user_id', '=', $user->id)->get();
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

        $tour = DB::table('360tool_tour')
            ->insert([
                'name' => $name,
                'start_at' => $start_at,
                'end_at' => $end_at,
                'type' => $type,
                'location' => $location,
                'description' => $description,
                'user_id' => Auth::id()
            ]);

        return redirect('/tours');
    }
}
