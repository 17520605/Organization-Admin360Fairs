<?php

namespace App\Http\Controllers\partner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class ToursController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();

        $role = "partner";
        $roles = array();

        $roles['partner'] = 'Partner';
        $tours = DB::table('tour')
            ->join('tour_partner', 'tour.id', '=', 'tour_partner.tourId')
            ->where([
                ['partnerId', '=', $profile->id],
                ['status', '!=', \App\Models\Tour_Partner::UNCONFIRMED],
            ])
            ->select('tour.*')
            ->get();
        
            foreach ($tours as $tour) {
                $booths = \App\Models\Booth::with('owner')->where([
                    ['ownerId', '=', $profile->id],
                    ['tourId', '=', $tour->id]
                ])->get();
                $tour->booths = $booths;
            }
        
        // check Admin
        if($user->level >= User::LEVEL_TOURADMIN){
            $roles['administrator'] = 'Administrator';
        }

        // check Speaker
        $speakerTours = DB::table('tour_speaker')->where([
            ['speakerId', '=', $profile->id],
            ['status', '!=', \App\Models\Tour_Speaker::UNCONFIRMED]
        ])->get();
        if(count($speakerTours) > 0){
            $roles['speaker'] = 'Speaker';
        }
        
        return view('partner.tours.index', [
            'profile' => $profile, 
            'tours'=> $tours,
            'role' => $role,
            'roles' => $roles
        ]);
    }
}
