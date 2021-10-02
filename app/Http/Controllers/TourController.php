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

        $tour = DB::table('360tool_tour')->find($id);
        return view('tour.index', ['user' => Auth::user(), 'tour'=>$tour]);
    }

    public function edit($id)
    {
        $tour = DB::table('360tool_tour')->find($id);
        return view('tour.edit', ['user' => Auth::user(),'tour' => $tour]);
    }

    public function saveEdit($id, Request $request)
    {
        $name = $request->name;
        $start_at = $request->start_at;
        $end_at = $request->end_at;
        $type = $request->type;
        $location = $request->location;
        $description = $request->description;

        $tour = DB::table('360tool_tour')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'start_at' => $start_at,
                'end_at' => $end_at,
                'type' => $type,
                'location' => $location,
                'description' => $description,
            ]);

         return redirect('/tours/'.$id.'/tour');
    }
}
