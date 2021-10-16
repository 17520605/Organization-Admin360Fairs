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
class SpeakersController extends Controller
{
    public function index($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $speakers = DB::table('tour_speaker')
            ->join('profile', 'profile.id', '=', 'tour_speaker.speakerId')
            ->where([
                ['tour_speaker.tourId', '=', $id],
            ])
            ->select('profile.*','status')
            ->get();

        return view('administrator.speakers.index', ['profile' => $profile, 'tour'=> $tour, 'speakers' => $speakers]);
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
                $user->type = 'speaker';
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

            $speaker = new \App\Models\Tour_Speaker();
            $speaker->tourId = $id;
            $speaker->speakerId = $profile->id;
            $speaker->status = \App\Models\Tour_Speaker::UNCONFIRMED;
            $speaker->save();
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
                $user->type = 'speaker';
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

            $speaker = new \App\Models\Tour_Speaker();
            $speaker->tourId = $id;
            $speaker->speakerId = $profile->id;
            $speaker->status = \App\Models\Tour_Speaker::UNCONFIRMED;
            $speaker->save();

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
                    $user->type = 'speaker';
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

                $speaker = new \App\Models\Tour_Speaker();
                $speaker->tourId = $id;
                $speaker->speakerId = $profile->id;
                $speaker->save();
            }

            return true;
        }
        else{
            return json_encode($check);
        }
    }
    public function sendEmails($id, Request $request)
    {
        $speakerIds = $request->speakerIds;

        foreach ($speakerIds as $speakerId) {

            $speaker = \App\Models\Profile::find($speakerId);

            $tour_speaker = \App\Models\Tour_Speaker::with('speaker')
                ->where([
                    ['tourId', '=', $id],
                    ['speakerId', '=', $speakerId],
                ])->first();
            $tour_speaker->status = \App\Models\Tour_Speaker::SENTEMAIL;
            $tour_speaker->code = Str::random(6);
            $tour_speaker->expiry = Carbon::now()->addMinute(5);
            $tour_speaker->save();

            $model = DB::table('tour_speaker')
                ->join('profile', 'profile.id', '=', 'tour_speaker.speakerId')
                ->where([
                    ['tour_speaker.tourId', '=', $id],
                    ['tour_speaker.speakerId', '=', $speakerId]
                ])
                ->select('tour_speaker.*')
                ->first();

            $mailer = new MailService(
                [$speaker->email],
                'Lời mời tham dự thuyết trình',
                'speaker',
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

        $speakerId = DB::table('tour_speaker')
            ->join('profile', 'profile.id', '=', 'tour_speaker.speakerId')
            ->where([
                ['tour_speaker.tourId', '=', $id],
                ['profile.email', '=', $email]
            ])->select('profile.id')
            ->first();
        
        if(isset($speakerId)){
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
