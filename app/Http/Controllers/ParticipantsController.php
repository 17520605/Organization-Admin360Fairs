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
        $participants = DB::table('tour_participant')
            ->join('profile', 'profile.id', '=', 'tour_participant.participantId')
            ->where([
                ['tour_participant.tourId', '=', $id],
            ])
            ->select('profile.*')
            ->get();

        return view('participants.index', ['user' => Auth::user(), 'tour'=> $tour, 'participants' => $participants]);
    }
    
    public function saveCreate($id, Request $request)
    {
        $tour = DB::table('tour')->find($id);

        $name = $request->name;
        $email = $request->email;
        $contact = $request->contact;
        

        $participantId = DB::table('tour_participant')
            ->join('profile', 'profile.id', '=', 'tour_participant.participantId')
            ->where([
                ['tour_participant.tourId', '=', $id],
                ['profile.email', '=', $email]
            ])
            ->select('profile.id')
            ->first();
        
        if(!isset($participantId)){ // khong phai la doi tac
            $profile = DB::table('profile')->where('email', $email)->first();
            if(!isset($profile )){ // chua có tài khoản
                // tao user
                $user = new \App\Models\User();
                $user->type = 'participant';
                $user->email = $email;
                $user->isRequiredChangePassword = true;
                $user->save();
                // tao profile
                $profile = new \App\Models\Profile();
                $profile->userId = $user->id;
                $profile->name = $name;
                $profile->email = $email;
                $profile->contact = $contact;
                $profile->save();
            }

            $participate = new \App\Models\Tour_Participant();
            $participate->tourId = $id;
            $participate->participantId = $profile->id;
            $participate->save();

            return true;
        }
        else{
            return response("Da ton tai.");
        }
        
        return false;
    }
}
