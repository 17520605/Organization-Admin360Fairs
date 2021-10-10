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
        return view('webinars.index', ['user' => Auth::user(), 'tour'=>$tour]);
    }

    public function webinar($id, $webinarId)
    {
        $tour = DB::table('tour')->find($id);
        return view('events.webinar', ['user' => Auth::user(), 'tour'=>$tour]);
    }
}
