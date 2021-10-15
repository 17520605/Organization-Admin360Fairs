<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ToursController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();

        $role = "administrator";
        $roles = array();
       
        $tours = DB::table('tour')->where('organizerId', '=', $profile->id)->get();
        $roles['administrator'] = 'Administrator';

        // check Participant
        $participantTours = DB::table('tour_participant')->where([
            ['participantId', '=', $profile->id],
            ['status', '!=', \App\Models\Tour_Participant::UNCONFIRMED]
        ])->get();
        if(count($participantTours) > 0){
            $roles['participant'] = 'Participant';
        }

        // check Speaker
        $speakerTours = DB::table('tour_speaker')->where([
            ['speakerId', '=', $profile->id],
            ['status', '!=', \App\Models\Tour_Speaker::UNCONFIRMED]
        ])->get();
        if(count($speakerTours) > 0){
            $roles['speaker'] = 'Speaker';
           
        }
        
        return view('administrator.tours.index', [
            'profile' => $profile, 
            'tours'=> $tours,
            'role' => $role,
            'roles' => $roles
        ]);
    }

    public function saveCreate(Request $request)
    {
        
        $name = $request->name;
        $start_at = $request->start_at;
        $end_at = $request->end_at;
        $type = $request->type;
        $location = $request->location;
        $description = $request->description;

        $tour = DB::table('tour')
            ->insert([
                'name' => $name,
                'startTime' => $start_at,
                'endTime' => $end_at,
                'location' => $location,
                'description' => $description,
                'organizerId' => Auth::id()
            ]);

        return redirect('administrator/tours');
    }
}
