<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RequestsController extends Controller
{
    public function index($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $webinars = \App\Models\Webinar::with('registrant')
            ->where([
                ['tourId', '=', $tour->id],
                ['isWaitingApproval', '=', true],
            ])
            ->get();

        $booths = \App\Models\Booth::with('owner')
            ->where([
                ['tourId', '=', $tour->id],
                ['isWaitingApproval', '=', true],
            ])
            ->get();
        
        return view('administrator.requests.index', [
            'profile' => $profile, 
            'tour'=> $tour ,
            'webinars'=>$webinars,
            'booths'=>$booths,
        ]);
    }

    public function getRequestCount($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $webinars = \App\Models\Webinar::with('registrant')
            ->where([
                ['tourId', '=', $tour->id],
                ['isWaitingApproval', '=', true],
            ])
            ->get();

        $booths = \App\Models\Booth::with('owner')
            ->where([
                ['tourId', '=', $tour->id],
                ['isWaitingApproval', '=', true],
            ])
            ->get();
        
        return (count($webinars) + count($booths));
    }
}
