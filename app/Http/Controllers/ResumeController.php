<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ResumeController extends Controller
{
    public function index($id ,Request $request)
    {
        $profile = DB::table('profile')->where('userId', $id)->first();
        return view('profile.resume', compact('profile'));
    }
}
