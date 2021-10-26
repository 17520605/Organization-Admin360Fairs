<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InterestController extends Controller
{
    public function index($id)
    {

        $tour = DB::table('tour')->find($id);
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();

        $interests = \App\Models\Interest::with('visitor','tour','booth','object')->get();

        return view('administrator.interest.index', [
            'profile' => $profile,
            'tour'=> $tour,
            'interests'=>$interests
        ]);
    }
}
