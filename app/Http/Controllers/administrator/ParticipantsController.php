<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use League\Csv\Reader;
use App\Mail\MailService;

class ParticipantsController extends Controller
{
    public function index($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $participants = DB::table('tour_participant')
            ->join('profile', 'profile.id', '=', 'tour_participant.participantId')
            ->where([
                ['tour_participant.tourId', '=', $id],
            ])
            ->select('profile.*', 'status')
            ->get();

        return view('administrator.participants.index', ['profile' => $profile, 'tour'=> $tour, 'participants' => $participants]);
    }
    
    public function saveCreate($id, Request $request)
    {   
        $tour = DB::table('tour')->find($id);

        $name = $request->name;
        $email = $request->email;
        $contact = $request->contact;
        
        $check = $this->checkCreate($id, $name,  $email, $contact);
        if($check['success'] == true){
            $profile = \App\Models\Profile::with('user')->where('email', $email)->first();
            if(!isset($profile )){ // chua có tài khoản
                // tao user
                $user = new \App\Models\User();
                $user->type = 'participant';
                $user->level = \App\Models\User::LEVEL_PARTICIPANT;
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

            $user = \App\Models\User::find($profile->userId);
            if($user->level < \App\Models\User::LEVEL_PARTICIPANT){
                $user->level = \App\Models\User::LEVEL_PARTICIPANT;
                $user->save();
            }

            $participate = new \App\Models\Tour_Participant();
            $participate->tourId = $id;
            $participate->participantId = $profile->id;
            $participate->status = \App\Models\Tour_Participant::UNCONFIRMED;
            $participate->save();
        }
        
        return json_encode($check);
    }

    public function saveEdit($id, Request $request)
    {
        $participantId = $request->id;
        $name = $request->name;
        $email = $request->email;
        $contact = $request->contact;

        $profile = DB::table('profile')
            ->where('id', $participantId)
            ->update([
                'name' => $name,
                'email' => $email,
                'contact' => $contact,
            ]);
        return back();
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
                $participate->status = \App\Models\Tour_Participant::UNCONFIRMED;
                $participate->save();
            }

            return true;
        }
        else{
            return json_encode($check);
        }
    }

    public function sendEmails($id, Request $request)
    {
        $participantIds = $request->participantIds;

        foreach ($participantIds as $participantId) {

            $participant = \App\Models\Profile::find($participantId);

            $tour_participant = \App\Models\Tour_Participant::with('participant')
                ->where([
                    ['tourId', '=', $id],
                    ['participantId', '=', $participantId],
                ])->first();
            $tour_participant->status = \App\Models\Tour_Participant::SENTEMAIL;
            $tour_participant->code = Str::random(6);
            $tour_participant->expiry = Carbon::now()->addMinute(5);
            $tour_participant->save();

            $model = DB::table('tour_participant')
                ->join('profile', 'profile.id', '=', 'tour_participant.participantId')
                ->where([
                    ['tour_participant.tourId', '=', $id],
                    ['tour_participant.participantId', '=', $participantId]
                ])
                ->select('tour_participant.*')
                ->first();

            $mailer = new MailService(
                [$participant->email],
                'Lời mời tham gia quản lý gian hàng',
                'default',
                $model
            );
            $mailer->sendMail();
        }

        return true;
        
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
