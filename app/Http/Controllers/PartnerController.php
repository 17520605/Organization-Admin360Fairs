<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PartnerController extends Controller
{
    public function verification($id)
    {
        $user = Auth::user();

        $tour_participant = DB::table('tour_participant')
            ->join('profile', 'profile.id', '=', 'tour_participant.participantId')
            ->where([
                ['tour_participant.id', '=', $id],
            ])
            ->select('tour_participant.*', 'email')
            ->first();
        
        if( $tour_participant->status == \App\Models\Tour_Participant::SENTEMAIL){
            if($tour_participant->incorrectCount <= 3){
                return view('partner.verification', ['user' => Auth::user(), 'tour_participant' => $tour_participant]);
            }
            else{
                return response("Ban da nhap qua so lan quy dinh");
            }
        }
        else{
            return response("Ban k co loi moi verify");
        }
    }

    public function confirmation(Request $request)
    {
        $id = $request->id;
        $code = $request->code;

        $tour_participant = \App\Models\Tour_Participant::find($id);
        if(isset($tour_participant)){
            if($tour_participant->incorrectCount <= 3){
                if($tour_participant->code == $code){
                    $tour_participant->status = \App\Models\Tour_Participant::CONFIRMED;
                    $tour_participant->save();
                    return json_encode(array(
                        'success' => true
                    ));
                }
                else{
                    $tour_participant->incorrectCount = $tour_participant->incorrectCount + 1;
                    $tour_participant->save();
                    return json_encode(array(
                        'success' => false,
                        'incorrectCount' => $tour_participant->incorrectCount
                    ));
                } 
            }
            else{
                return json_encode(array(
                    'success' => false,
                    'incorrectCount' => $tour_participant->incorrectCount,
                    'message' => 'Please check your email and re-send code'
                ));
            }
            
        } 
    }
    
}
