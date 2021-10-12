<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ParticipantsController extends Controller
{
    public function index($id)
    {
        $tour = DB::table('tour')->find($id);
        return view('participants.index', ['user' => Auth::user(), 'tour'=> $tour]);
    }
    
    public function saveCreate($id)
    {
        $tour = DB::table('tour')->find($id);
        
    }
}
