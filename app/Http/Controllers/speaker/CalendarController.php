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
    public function index($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();

        // $webinars = DB::table('webinar_detail')
        //     ->join('webinar', 'webinar.id', '=', 'webinar_detail.webinarId')
        //     ->where('webinar_detail.speakerId', $profile->id)
        //     ->select('webinar.*')
        //     ->distinct()
        //     ->get();
        
        $webinars = \App\Models\Webinar::with('details')
            ->where([
                ['tourId', '=', $id],
                ['isDeleted', '=', false],
            ])
            ->whereHas('details', function ($q) use($profile){
                $q->where('speakerId', '=', $profile->id);
            })
            ->orderBy('startAt', 'ASC')
            ->get();

        $tour = DB::table('tour')->find(1);

        return view('speaker.calendar.index', [
            'profile' => $profile,
            'tour' => $tour,
            'webinars' => $webinars
        ]);
    }

      
    public function calendar($id, $speakerId, Request $request)
    {
        $webinars = DB::table('webinar_detail')
            ->join('webinar', 'webinar.id', '=', 'webinar_detail.webinarId')
            ->where('webinar_detail.speakerId', $speakerId)
            ->select('webinar.*')
            ->distinct()
            ->get();
        
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();
        $tour = DB::table('tour')->find(1);

        return view('administrator.speakers.calendar', [
            'profile' => $profile,
            'tour' => $tour,
            'webinars' => $webinars
        ]);
    }

}
