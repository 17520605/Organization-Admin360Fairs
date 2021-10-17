<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function webinars($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $webinars = \App\Models\Webinar::with('details')
            ->where('tourId', $id)
            ->get();
        $speakers = DB::table('tour_speaker')
            ->join('profile', 'profile.id', '=', 'tour_speaker.speakerId')
            ->where('tour_speaker.tourId', $id)
            ->select('profile.*')
            ->get();

        return view('administrator.events.webinars', ['profile' => $profile , 'tour'=>$tour, 'webinars' => $webinars,'speakers' => $speakers]);
    }

    public function webinar($id, $webinarId)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $webinar = \App\Models\Webinar::with('details')
            ->where('id',$webinarId)
            ->first();
        foreach ($webinar->details as $detail) {
            $detail->speaker = DB::table('profile')->find($detail->speakerId);
        }
        return view('administrator.events.webinar', ['profile' => $profile , 'webinar' => $webinar, 'tour'=>$tour]);
    }

    public function saveCreate($id, Request $request)
    {
        $topic = $request->topic;
        $start = $request->start;
        $end = $request->end;
        $description = $request->description;
        $titles = $request->titles;
        $durations = $request->durations;
        $speakers = $request->speakers;

        $webinar = new \App\Models\Webinar();
        $webinar->topic = $topic;
        $webinar->description = $description;
        $webinar->startAt = $start;
        $webinar->endAt = $end;
        $webinar->save();

        for ($i=0; $i < count($titles); $i++) { 
            $detail = new \App\Models\WebinarDetail();
            $detail->webinarId = $webinar->id;
            $detail->title = $titles[$i];
            $detail->duration = $durations[$i];
            $detail->speakerId = $speakers[$i];
            $detail->save();
        }

        return back();
    }
}
