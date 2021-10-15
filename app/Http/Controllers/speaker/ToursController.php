<?php

namespace App\Http\Controllers\speaker;

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

        $role = "speaker";
        $roles = array();

        $roles['speaker'] = 'Speaker';
        $tours = DB::table('tour')
            ->join('tour_speaker', 'tour.id', '=', 'tour_speaker.tourId')
            ->where([
                ['speakerId', '=', $profile->id],
                ['status', '!=', \App\Models\Tour_Speaker::UNCONFIRMED],
            ])
            ->select('tour.*')
            ->get();
        
        // check Admin
        if($user->level >= User::LEVEL_TOURADMIN){
            $roles['administrator'] = 'Administrator';
        }

        // check Participant
        $participantTours = DB::table('tour_participant')->where([
            ['participantId', '=', $user->id],
            ['status', '!=', \App\Models\Tour_Participant::UNCONFIRMED]
        ])->get();
        if(count($participantTours) > 0){
            $roles['participant'] = 'Participant';
        }
        
        return view('speaker.tours.index', [
            'profile' => $profile, 
            'tours'=> $tours,
            'role' => $role,
            'roles' => $roles
        ]);
    }
}
