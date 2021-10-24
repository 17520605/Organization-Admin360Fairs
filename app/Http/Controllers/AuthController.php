<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            $url = $request->get('url');
            $email = $request->get('email');

            $user = \App\Models\User::where('email',  $email)->first();
            if($user != null){
                if($user->isRequiredChangePassword == true || $user->password == null){
                    return view('auth.init_password', ['email' => $user->email]);
                }
                else{
                    return view('auth.login', ['url' => $url, 'email' => $email]);
                }
            }
            else{
                return view('auth.login', ['url' => $url]);
            }
        }

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $role = $request->role;

            if($request->url != null){
                return redirect($request->url);
            }
            else{
                return redirect('/'.$role);
            }
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function register(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            $url = $request->get('url');
            return view('auth.register');
        }

        $email = $request->email;
        $password = $request->password;

        $user = new User;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->level = 1;
        $user->save();

        return redirect('/login');
    }

    public function initPassword(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            $email = $request->get('email');
            $user = User::where('email', $email)->first();
            if($user != null){
                if ($user->password == null){
                    return view('auth.init_password', ['email' => $email]);
                }
                else{
                    return response("Tai khoan da duoc khoi tao mat khau. Khong the khoi tao lai mat khau");
                }    
            }
            else{
                return response("email khong ton tai");
            }
        }

        $email = $request->get('email');
        $password = $request->password;

        $user = User::where('email', $email)->first();
        $user->password = bcrypt($password);
        $user->isRequiredChangePassword = false;
        $user->save();

        return redirect('/login?email='.$email);
    }

    public function forgot()
    {
        return view('auth.forgot');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function verification($id, Request $request)
    {
        $user = Auth::user();
        $role = $request->get('role');
        $code = $request->get('code');
        
        if($role == 'partner'){
            $tour_partner = DB::table('tour_partner')
                ->join('profile', 'profile.id', '=', 'tour_partner.partnerId')
                ->where([
                    ['tour_partner.id', '=', $id],
                ])
                ->select('tour_partner.*', 'email')
                ->first();
            
            if( $tour_partner->status == \App\Models\Tour_Partner::SENTEMAIL){
                if($tour_partner->incorrectCount <= 3){
                    return view('auth.verification', ['user' => Auth::user(), 'tour_partner' => $tour_partner]);
                }
                else{
                    return response("Ban da nhap qua so lan quy dinh");
                }
            }
            else{
                return response("Ban k co loi moi verify");
            }
        }
        else
        if($role == 'speaker'){
            $tour_speaker = \App\Models\Tour_Speaker::with('speaker')->find($id);   
            if( $tour_speaker != null)
            {
                if($tour_speaker->status == \App\Models\Tour_Speaker::SENTEMAIL){
                    if( $tour_speaker->incorrectCount <= 3){
                        if($tour_speaker->code == $code){
                            $tour_speaker->status = \App\Models\Tour_Speaker::CONFIRMED;
                            $tour_speaker->save();
                            return redirect('/login?email='.$tour_speaker->speaker->email);
                        }
                        else{
                            $tour_speaker->incorrectCount = $tour_speaker->incorrectCount + 1;
                            $tour_speaker->save();
                            return response("Xac nhan that bai");
                        }
                    }
                    else{
                        return response("Loi moi qua han");
                    }
                }
                else{
                    return response("Ban da xac nhan loi moi");
                }
            } 
            else{
                return response("Not found");
            }
        }
        
    }

    public function confirmation(Request $request)
    {
        $id = $request->id;
        $code = $request->code;
        $role = $request->get('role');
        if($role == 'partner'){
            $tour_partner = \App\Models\Tour_Partner::find($id);
            if(isset($tour_partner)){
                if($tour_partner->incorrectCount <= 3){
                    if($tour_partner->code == $code){
                        $tour_partner->status = \App\Models\Tour_Partner::CONFIRMED;
                        $tour_partner->save();
                        return json_encode(array(
                            'success' => true
                        ));
                    }
                    else{
                        $tour_partner->incorrectCount = $tour_partner->incorrectCount + 1;
                        $tour_partner->save();
                        return json_encode(array(
                            'success' => false,
                            'incorrectCount' => $tour_partner->incorrectCount
                        ));
                    } 
                }
                else{
                    return json_encode(array(
                        'success' => false,
                        'incorrectCount' => $tour_partner->incorrectCount,
                        'message' => 'Please check your email and re-send code'
                    ));
                }
            } 
        }
        else
        if($role == 'speaker'){
            $tour_speaker = \App\Models\Tour_Speaker::find($id);
            if(isset($tour_speaker)){
                if($tour_speaker->incorrectCount <= 3){
                    if($tour_speaker->code == $code){
                        $tour_speaker->status = \App\Models\Tour_Speaker::CONFIRMED;
                        $tour_speaker->save();
                        return json_encode(array(
                            'success' => true
                        ));
                    }
                    else{
                        $tour_speaker->incorrectCount = $tour_speaker->incorrectCount + 1;
                        $tour_speaker->save();
                        return json_encode(array(
                            'success' => false,
                            'incorrectCount' => $tour_speaker->incorrectCount
                        ));
                    } 
                }
                else{
                    return json_encode(array(
                        'success' => false,
                        'incorrectCount' => $tour_speaker->incorrectCount,
                        'message' => 'Please check your email and re-send code'
                    ));
                }
            } 
        }
        
    }
}
