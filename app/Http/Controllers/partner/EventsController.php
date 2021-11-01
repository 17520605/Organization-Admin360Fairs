<?php

namespace App\Http\Controllers\partner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Support\Entry;
use MacsiDigital\Zoom\Facades\Zoom;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function webinars($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $tag = $request->get('tag');

        $all_dates = DB::table('webinar')->where([
                ['tourId', '=', $id],
                ['isDeleted', '=', false],
                ['isConfirmed', '=', true]
            ])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(DB::raw('Date(startAt) as date'));
        foreach ($all_dates as $date) {
            $webinars = \App\Models\Webinar::with('details')
                ->where([
                    ['tourId', '=', $id],
                    ['isDeleted', '=', false],
                    ['isConfirmed', '=', true]
                ])
                ->whereRaw("Date(startAt) = ?", array($date->date))
                ->orderBy('startAt', 'ASC')
                ->get();
            $date->webinars = $webinars;
        }

        $my_dates = DB::table('webinar')->where([
                ['tourId', '=', $id],
                ['registerBy', '=', $profile->id],
                ['isDeleted', '=', false],
                ['isConfirmed', '=', true]
            ])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(DB::raw('Date(startAt) as date'));
        foreach ($my_dates as $date) {
            $webinars = \App\Models\Webinar::with('details')
                ->where([
                    ['tourId', '=', $id],
                    ['registerBy', '=', $profile->id],
                    ['isDeleted', '=', false],
                    ['isConfirmed', '=', true]
                ])
                ->whereRaw("Date(startAt) = ?", array($date->date))
                ->orderBy('startAt', 'ASC')
                ->get();
            $date->webinars = $webinars;
        }

        $webinars = \App\Models\Webinar::with('details')
            ->where([
                ['tourId', '=', $id],
                ['isDeleted', '=', false],
                ['isConfirmed', '=', true]
            ])
            ->orderBy('startAt', 'ASC')
            ->get();

        $speakers = DB::table('tour_speaker')
            ->join('profile', 'profile.id', '=', 'tour_speaker.speakerId')
            ->where('tour_speaker.tourId', $id)
            ->select('profile.*')
            ->get();

        return view('partner.events.webinars', [
            'profile' => $profile ,
            'tour'=>$tour,
            'all_dates' => $all_dates,
            'my_dates' => $my_dates,
            'webinars'=>$webinars, 
            'speakers' => $speakers,
            'tag' => $tag
        ]);

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

        $speakers = DB::table('tour_speaker')
            ->join('profile', 'profile.id', '=', 'tour_speaker.speakerId')
            ->where([
                ['tour_speaker.tourId','=', $id],
                ['tour_speaker.status','=', \App\Models\Tour_Speaker::CONFIRMED],
            ])
            ->select('profile.*')
            ->get();

        return view('partner.events.webinar', [
            'profile' => $profile , 
            'webinar' => $webinar, 
            'speakers'=> $speakers, 
            'tour'=>$tour
        ]);
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
            $detail = new \App\Models\Webinar_Detail();
            $detail->webinarId = $webinar->id;
            $detail->title = $titles[$i];
            $detail->duration = $durations[$i];
            $detail->speakerId = $speakers[$i];
            $detail->save();
        }

        $zoom = new \MacsiDigital\Zoom\Support\Entry;
        $user = new \MacsiDigital\Zoom\User($zoom);

        return back();
    }

    public function saveEdit( Request $request)
    {
        $webinarId = $request->webinarId;
        $topic = $request->topic;
        $start = $request->start;
        $end = $request->end;
        $description = $request->description;
        $titles = $request->titles;
        $durations = $request->durations;
        $speakers = $request->speakers;

        $webinar = \App\Models\Webinar::find($webinarId);
        $webinar->topic = $topic;
        $webinar->startAt = $start;
        $webinar->endAt = $end;
        $webinar->description = $description;
        $webinar->save();

        $details = \App\Models\Webinar_Detail::where('webinarId', $webinarId);
        $details->delete();

        for ($i=0; $i < count($titles); $i++) { 
            if($titles[$i] != null ){
                $detail = new \App\Models\Webinar_Detail();
                $detail->webinarId = $webinarId;
                $detail->title = $titles[$i];
                $detail->duration = $durations[$i];
                $detail->speakerId = $speakers[$i];
                $detail->save();
            }
        }

        return back();
    }

    public function saveDelete($id, $webinarId, Request $request)
    {
        $webinar = \App\Models\Webinar::find($webinarId);
        $webinar->isDeleted = true ;
        $webinar->save();

        $webinar_speaker = \App\Models\Webinar_Detail::where('webinarId', $webinarId)->delete();

        return true;
    }

    
}
