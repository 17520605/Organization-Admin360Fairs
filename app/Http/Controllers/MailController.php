<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\MailService;

class MailController extends Controller
{
    public function send(Request $request)
    {

        $emais = [
            'nguyenngockhai25@gmail.com',
            '17520607@gm.uit.edu.vn',
            'nguyenhuuminhkhai@gmail.com'
        ];
        $subject = "subject";
        $view = 'default';
        $model = "";

        $service = new MailService($emais,  $subject, $view, $model);
        $service->sendMail();

        dd("Email is Sent.");
        
    }
    
}
