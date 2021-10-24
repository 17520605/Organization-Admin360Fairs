<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TourController extends Controller
{
    public function index($id)
    {

        $tour = DB::table('tour')->find($id);
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();
        return view('speaker.tour.index', [
            'profile' => $profile,
            'tour'=> $tour,
            
        ]);
    }
}
