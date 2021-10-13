<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use League\Csv\Reader;

class SpeakersController extends Controller
{
    public function index($id)
    {
        $tour = DB::table('tour')->find($id);
        $speakers = DB::table('tour_speaker')
            ->join('profile', 'profile.id', '=', 'tour_speaker.speakerId')
            ->where([
                ['tour_speaker.tourId', '=', $id],
            ])
            ->select('profile.*')
            ->get();

        return view('speakers.index', ['user' => Auth::user(), 'tour'=> $tour, 'speakers' => $speakers]);
    }
    
    public function saveCreate($id, Request $request)
    {
        $tour = DB::table('tour')->find($id);

        $name = $request->name;
        $email = $request->email;
        $contact = $request->contact;
        
        $check = $this->checkCreate($id, $name,  $email, $contact);
        if($check['success'] == true){
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
        }
        
        return json_encode($check);
    }

    public function saveEdit($id, Request $request)
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

    public function importCsv($id, Request $request)
    {
        $check = json_decode($this->checkImportCsv($id,  $request));

        if($check->success == true){
            $file = $request->file('csv');
            $reader = Reader::createFromFileObject($file->openFile());
            $line = 0;
            foreach ($reader as $index => $row) {
                $line ++;
                
                // bo header
                if($line <= 1) continue;

                $name = $row[0];
                $email = $row[1];
                $contact = $row[2];

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
            }

            return true;
        }
        else{
            return json_encode($check);
        }
    }

    public function checkImportCsv($id, Request $request)
    {
        $file = $request->file('csv');
        $reader = Reader::createFromFileObject($file->openFile());
        $errors = array();
        $line = 0;
        $correctCount = 0;

        foreach ($reader as $index => $row) {
            $line ++;

            // bo header
            if($line <= 1) continue;

            $name = $row[0];
            $email = $row[1];
            $contact = $row[2];

            $check = $this->checkCreate($id, $name,  $email, $contact);
            if($check['success'] == true){
                $correctCount ++;
            }
            else{
                $errors[$line] = $check['error'];
            }
        }

        $res = array();
        $res['totalCount'] = $line - 1;
        $res['correctCount'] = $correctCount;
        $res['incorrectCount'] = $line - 1 - $correctCount;
        $res['errors'] = $errors;

        if($res['totalCount'] == $res['correctCount'] ){
            $res['success'] = true;
        } 
        else{
            $res['success'] = false;
        }

        return json_encode($res);
    }

    public function checkCreate($id, $name, $email , $contact)
    {   
        $check = [];
        $check['success'] = false;
        $check['error'] = array();

        if($name == "" && $email == "" && $email == "" ){
            $check['error'] = "Incorrect values or format";
            return $check;
        }

        if(!isset($name) || $name == "" || !isset($email) || $email == "" || !isset($contact) || $contact == "")
        {
            $check['error'] = "Incorrect values or format";
            return $check;
        }

        $participantId = DB::table('tour_participant')
            ->join('profile', 'profile.id', '=', 'tour_participant.participantId')
            ->where([
                ['tour_participant.tourId', '=', $id],
                ['profile.email', '=', $email]
            ])->select('profile.id')
            ->first();
        
        if(isset($participantId)){
            $check['error'] = "Email already exists";
        }
        else{
            $check['success'] = true;
        }

        return $check;
    }

    public function checkEdit($id, $name, $email , $contact)
    {
       
    }
}
