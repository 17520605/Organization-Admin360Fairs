<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function webinars($id)
    {
        $tour = DB::table('tour')->find($id);
        $speakers = \App\Models\Profile::where([
            ['type', '=', 'speaker'],
            ['tourId', '=', $id]
        ]);

        return view('events.webinars', ['user' => Auth::user(), 'tour'=>$tour, 'speakers' => $speakers]);
    }

    public function webinar($id, $webinarId)
    {
        $tour = DB::table('tour')->find($id);
        return view('events.webinar', ['user' => Auth::user(), 'tour'=>$tour]);
    }
}
