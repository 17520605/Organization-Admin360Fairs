<?php

namespace App\Http\Controllers\speaker;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class CalendarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();
        $tour = DB::table('tour')->find(1);
        return view('speaker.calendar.index', [
            'profile' => $profile,
            'tour' => $tour
        ]);
    }
}
