<?php

namespace App\Http\Controllers\participant;

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

        $role = "participant";
        $roles = array();

        $roles['participant'] = 'Participant';
        $tours = DB::table('tour')
            ->join('tour_participant', 'tour.id', '=', 'tour_participant.tourId')
            ->where([
                ['participantId', '=', $profile->id],
                ['status', '!=', \App\Models\Tour_Participant::UNCONFIRMED],
            ])
            ->select('tour.*')
            ->get();
        
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
        
        return view('participant.tours.index', [
            'profile' => $profile, 
            'tours'=> $tours,
            'role' => $role,
            'roles' => $roles
        ]);
    }
}
