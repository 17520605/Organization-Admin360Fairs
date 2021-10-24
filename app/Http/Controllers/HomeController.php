<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();

        $myTours = DB::table('tour')->where('organizerId', '=', $profile->id)->get();
        
        $partnerTours = DB::table('tour_partner')->where([
            ['partnerId', '=', $profile->id]
        ])->get();

        $speakerTours = DB::table('tour_speaker')->where([
            ['speakerId', '=', $profile->id]
        ])->get();
            
        if(count($myTours) > 0){
            return redirect('/administrator/tours');
        }

        if(count($partnerTours) > 0){
            return redirect('/partner/tours');
        }

        if(count($speakerTours) > 0){
            return redirect('/speaker/tours');
        }
 
    }
}
