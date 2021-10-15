<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            return view('auth.login', ['url' => $url, 'email' => $email]);
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
}
