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

class PartnersController extends Controller
{
    public function index($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $partners = DB::table('tour_partner')
            ->join('profile', 'profile.id', '=', 'tour_partner.partnerId')
            ->where([
                ['tour_partner.tourId', '=', $id],
            ])
            ->select('profile.*', 'status')
            ->get();

        return view('administrator.partners.index', ['profile' => $profile, 'tour'=> $tour, 'partners' => $partners]);
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
                $user->type = 'partner';
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

            $participate = new \App\Models\Tour_Partner();
            $participate->tourId = $id;
            $participate->partnerId = $profile->id;
            $participate->status = \App\Models\Tour_Partner::UNCONFIRMED;
            $participate->save();
        }
        
        return json_encode($check);
    }

    public function saveEdit($id, Request $request)
    {
        $partnerId = $request->partnerId;
        $name = $request->name;
        $email = $request->email;
        $contact = $request->contact;

        $check = $this->checkEdit($id, $partnerId, $name,  $email, $contact);
        if($check['success'] == true){
            $profile = \App\Models\Profile::with('user')->where('id', $partnerId)->first();
            $profile->name = $name;
            $profile->email = $email;
            $profile->contact = $contact;
            $profile->save();
        }

        return json_encode($check);
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
                    $user->type = 'partner';
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

                $participate = new \App\Models\Tour_Partner();
                $participate->tourId = $id;
                $participate->partnerId = $profile->id;
                $participate->status = \App\Models\Tour_Partner::UNCONFIRMED;
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
        $partnerIds = $request->partnerIds;

        foreach ($partnerIds as $partnerId) {

            $partner = \App\Models\Profile::find($partnerId);

            $tour_partner = \App\Models\Tour_Partner::with('partner')
                ->where([
                    ['tourId', '=', $id],
                    ['partnerId', '=', $partnerId],
                ])->first();
            $tour_partner->status = \App\Models\Tour_Partner::SENTEMAIL;
            $tour_partner->code = Str::random(6);
            $tour_partner->expiry = Carbon::now()->addMinute(5);
            $tour_partner->save();

            $model = DB::table('tour_partner')
                ->join('profile', 'profile.id', '=', 'tour_partner.partnerId')
                ->where([
                    ['tour_partner.tourId', '=', $id],
                    ['tour_partner.partnerId', '=', $partnerId]
                ])
                ->select('tour_partner.*')
                ->first();

            $mailer = new MailService(
                [$partner->email],
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
                $errors[$line] = $check['errors'];
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
        $check['success'] = true;
        $check['errors'] = array();

        if($name == "" && $email == "" && $email == "" ){
            $check['errors'] = "Incorrect values or format";
            return $check;
        }

        if(!isset($name) || $name == "" || !isset($email) || $email == "" || !isset($contact) || $contact == "")
        {
            $check['errors'] = "Incorrect values or format";
            return $check;
        }

        $profileByEmail = DB::table('tour_partner')
            ->join('profile', 'profile.id', '=', 'tour_partner.partnerId')
            ->where([
                ['tour_partner.tourId', '=', $id],
                ['profile.email', '=', $email],
            ])
            ->select('profile.*')
            ->first();
    
        $profileByContact = DB::table('tour_partner')
            ->join('profile', 'profile.id', '=', 'tour_partner.partnerId')
            ->where([
                ['tour_partner.tourId', '=', $id],
                ['profile.contact', '=', $contact],
            ])
            ->select('profile.*')
            ->first();
        
        if(isset($profileByEmail)){
            $check['errors']['email'] = "Email already exists";
            $check['success'] = false;
        }
        if(isset($profileByContact)){
            $check['errors']['contact'] = "Contact already exists";
            $check['success'] = false;
        }

        return $check;
    }

    public function checkEdit($id, $partnerId, $name, $email , $contact)
    {
        $check = [];
        $check['success'] = true;
        $check['errors'] = array();

        if($name == "" && $email == "" && $email == "" ){
            $check['errors'] = "Incorrect values or format";
            return $check;
        }

        if(!isset($name) || $name == "" || !isset($email) || $email == "" || !isset($contact) || $contact == "")
        {
            $check['errors'] = "Incorrect values or format";
            return $check;
        }

        $profile = DB::table('profile')->find($partnerId);
            
        $profileByEmail = DB::table('tour_partner')
            ->join('profile', 'profile.id', '=', 'tour_partner.partnerId')
            ->where([
                ['tour_partner.tourId', '=', $id],
                ['profile.email', '=', $email],
            ])
            ->select('profile.*')
            ->first();
        
        $profileByContact = DB::table('tour_partner')
            ->join('profile', 'profile.id', '=', 'tour_partner.partnerId')
            ->where([
                ['tour_partner.tourId', '=', $id],
                ['profile.contact', '=', $contact],
            ])
            ->select('profile.*')
            ->first();
        
        if(isset($profileByEmail) && $profileByEmail->email != $profile->email){
            $check['errors']['email'] = "Email already exists";
            $check['success'] = false;
        }
        if(isset($contact) && $profileByContact->contact != $profile->contact){
            $check['errors']['contact'] = "Contact already exists";
            $check['success'] = false;
        }

        return $check;
    }

    public function saveDelete($id, $partnerId, Request $request)
    {
        $partner = \App\Models\Tour_Partner::where('partnerId',$partnerId)->delete();
        return true;
    }
}
