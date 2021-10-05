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
            return view('auth.login', ['url' => $url]);
        }

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            if($request->url != null){
                return redirect($request->url);
            }
            else{
                return redirect('/');
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
