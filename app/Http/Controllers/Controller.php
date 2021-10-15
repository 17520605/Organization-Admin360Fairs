<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $profile = DB::table('profile')->where('userId', $user->id)->first();

            $parameters = Route::getCurrentRoute()->parameters();
            $role = explode('/', Route::getCurrentRoute()->uri)[0];

            if($role == 'administrator' && $user->level < User::LEVEL_TOURADMIN){
                return response(view('others.permission_denied'));
            }
            else
            if($role == 'participant' && $user->level < User::LEVEL_PARTICIPANT){
                return response(view('others.permission_denied'));
            }
            else
            if($role == 'speaker' && $user->level < User::LEVEL_SPEAKER){
                return response(view('others.permission_denied'));
            }

            if(array_key_exists('id', $parameters)){
                $tourId = Route::getCurrentRoute()->parameters()['id'];
  
                if($tourId != null){ 
                    if($profile != null){
                        $tour = DB::table('tour')->find($tourId);
                        if($tour != null){
                            if($role == 'administrator'){
                                if($tour->organizerId == $profile->id){
                                    return $next($request);
                                }
                                else{
                                    return response(view('others.permission_denied'));
                                }
                            } 
                            else
                            if($role == 'participant'){
                                $tour_participant = DB::table('tour_participant')
                                ->where([
                                    ['tour_participant.tourId', '=', $tourId],
                                    ['tour_participant.participantId', '=', $profile->id],
                                    ['tour_participant.status', '!=', \App\Models\Tour_Participant::UNCONFIRMED]
                                ])
                                ->first();
    
                                if($tour_participant != null){
                                    return $next($request);
                                }else{
                                    return response(view('others.permission_denied'));
                                }
                            }
                            else
                            if($role == 'speaker'){
                                $tour_speaker = DB::table('tour_speaker')
                                ->where([
                                    ['tour_speaker.tourId', '=', $tourId],
                                    ['tour_speaker.speakerId', '=', $profile->id],
                                    ['tour_speaker.status', '!=', \App\Models\Tour_Speaker::UNCONFIRMED]
                                ])
                                ->first();
    
                                if($tour_speaker != null){
                                    return $next($request);
                                }else{
                                    return response(view('others.permission_denied'));
                                }
                            }
                        }
                    }
                }
            }

            return $next($request);
        });
        
    }
}
