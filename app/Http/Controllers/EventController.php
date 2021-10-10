<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function webinar($id)
    {

        $tour = DB::table('tour')->find($id);
        return view('webinar.index', ['user' => Auth::user(), 'tour'=>$tour]);
    }
}
