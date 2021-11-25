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
        $booth = DB::table('booth')->find($id);
        $tour = DB::table('tour')->find($booth->tourId);
        $tag = $request->get('tag');

        $all_dates = DB::table('webinar')->where([
                ['tourId', '=', $tour->id],
                ['isDeleted', '=', false],
                ['isConfirmed', '=', true],
            ])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(DB::raw('Date(startAt) as date'));
        foreach ($all_dates as $date) {
            $webinars = \App\Models\Webinar::with('details')
                ->where([
                    ['tourId', '=', $tour->id],
                    ['isDeleted', '=', false],
                    ['isConfirmed', '=', true],
                ])
                ->whereRaw("Date(startAt) = ?", array($date->date))
                ->orderBy('startAt', 'ASC')
                ->get();
            $date->webinars = $webinars;
        }

        $my_dates = DB::table('webinar')->where([
                ['tourId', '=', $tour->id],
                ['registerBy', '=', $profile->id],
                ['isDeleted', '=', false],
                ['isConfirmed', '=', true],
            ])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(DB::raw('Date(startAt) as date'));
        foreach ($my_dates as $date) {
            $webinars = \App\Models\Webinar::with('details')
                ->where([
                    ['tourId', '=', $tour->id],
                    ['registerBy', '=', $profile->id],
                    ['isConfirmed', '=', true],
                    ['isDeleted', '=', false],
                ])
                ->whereRaw("Date(startAt) = ?", array($date->date))
                ->orderBy('startAt', 'ASC')
                ->get();
            $date->webinars = $webinars;
        }

        $webinars = \App\Models\Webinar::with('details')
            ->where([
                ['tourId', '=', $tour->id],
                ['isDeleted', '=', false],
            ])
            ->orderBy('startAt', 'ASC')
            ->get();

        $speakers = DB::table('tour_speaker')
            ->join('profile', 'profile.id', '=', 'tour_speaker.speakerId')
            ->where('tour_speaker.tourId', $tour->id)
            ->select('profile.*')
            ->get();

        return view('partner.events.webinars', [
            'profile' => $profile , 
            'tour'=>$tour, 
            'booth'=>$booth, 
            'all_dates' => $all_dates,
            'my_dates' => $my_dates,
            'webinars'=>$webinars, 
            'speakers' => $speakers,
            'tag' => $tag
        ]);
    }

    public function request($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $tag = $request->get('tag');

        $webinars = \App\Models\Webinar::with('details','registrant')
            ->where([
                ['tourId', '=', $id],
                ['isDeleted', '=', false],
            ])
            ->orderBy('startAt', 'ASC')
            ->get();

        $speakers = DB::table('tour_speaker')
            ->join('profile', 'profile.id', '=', 'tour_speaker.speakerId')
            ->where('tour_speaker.tourId', $id)
            ->select('profile.*')
            ->get();

        return view('partner.events.request', [
            'profile' => $profile , 
            'tour'=>$tour, 
            'webinars'=>$webinars, 
            'speakers' => $speakers,
            'tag' => $tag
        ]);
    }

    public function webinar($id, $webinarId)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $booth = DB::table('booth')->find($id);
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
            'booth'=>$booth
        ]);
    }

    public function create($id, Request $request)
    {     
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $booth = DB::table('booth')->find($id);

        return view('partner.events.create', [
            'profile' => $profile , 
            'booth'=>$booth
        ]);
    }

    public function edit($id, $webinarId, Request $request)
    {     
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $booth = DB::table('booth')->find($id);

        $webinar = \App\Models\Webinar::with('details', 'speakers', 'registrant')
            ->where('id',$webinarId)
            ->first();

        return view('partner.events.edit', [
            'profile' => $profile , 
            'tour'=>$tour,
            'tour'=>$booth,
            'webinar' => $webinar
        ]);
    }

    public function saveCreate($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $booth = DB::table('booth')->find($id);
        $tour = DB::table('tour')->find($booth->tourId);

        $topic = $request->topic;
        $poster = $request->poster;
        $start = $request->start;
        $end = $request->end;
        $description = $request->description;

        $speakerNos = $request->speakerNos;
        $speakerHonorifics = $request->speakerHonorifics;
        $speakerNames = $request->speakerNames;
        $speakerPositions = $request->speakerPositions;
        $speakerAvatars = $request->speakerAvatars;
        
        $detailTitles = $request->detailTitles;
        $detailDurations = $request->detailDurations;
        $detailSpeakerNos = $request->detailSpeakerNos;
        $detailContents = $request->detailContents;

        // save file to cloud
        $posterUrl = isset($poster) ? $this->uploadFile($poster, true)->url : 'https://res.cloudinary.com/virtual-tour/image/upload/v1637651914/Background/webinar-default-poster_f23c8z.jpg';
        $avatarUrls = [];
        foreach ($speakerNames as $key => $value) {
            $url = 'https://res.cloudinary.com/virtual-tour/image/upload/v1634458347/icons/default-avatar_muo2gc.jpg';
            if(isset($speakerAvatars[$key])){
                $file = $speakerAvatars[$key];
                $url = $this->uploadFile($file, true)->url;
            }
            $avatarUrls[$key] = $url;
        }

        $webinar = new \App\Models\Webinar();
        $webinar->tourId = $id ;
        $webinar->registerBy = $profile->id;
        $webinar->topic = $topic;
        $webinar->poster = $posterUrl;
        $webinar->description = $description;
        $webinar->startAt = $start;
        $webinar->endAt = $end;
        if($profile->id ==  $tour->organizerId){
            $webinar->isConfirmed = true;
        }
        $webinar->save();

        // create speakers
        $speakers = [];
        foreach ($speakerNos as $key => $value) {
            $name = $speakerNames[$key];
            $avatarUrl = $avatarUrls[$key];
            $honorific = $speakerHonorifics[$key];
            $position = $speakerPositions[$key];

            $speaker = new \App\Models\Speaker();
            $speaker->webinarId = $webinar->id;
            $speaker->name = $name;
            $speaker->avatar = $avatarUrl;
            $speaker->honorific = $honorific;
            $speaker->position = $position;
            $speaker->save();
            $speakers[$value] = $speaker;
        }

        // create details
        foreach ($detailTitles as $key => $value) {
            $detail = new \App\Models\Webinar_Detail();
            $detail->webinarId = $webinar->id;
            $detail->title = $detailTitles[$key];
            $detail->duration = $detailDurations[$key];
            $detail->content = $detailContents[$key];
            $detail->speakerId = $speakers[$detailSpeakerNos[$key]]->id;
            $detail->save();
        }

        $webinar = \App\Models\Webinar::with('details', 'speakers', 'registrant')->find($webinar->id);

        if($profile->id !=  $tour->organizerId){
            // send notification to user registered webinar
            $notification = new \App\Models\Notification();
            $notification->tourId = $tour->id;
            $notification->to = 'users@'.$webinar->registrant->id;
            $notification->channel = 'webinar@new';
            $notification->type = \App\Models\Notification::INFO;
            $notification->title = "You register a new webinar";
            $notification->content = '<a href="/partner/booths/'.$booth->id.'/events/webinars/'.$webinar->id.'">'.$webinar->topic.'</a>';
            $notification->save();
            $notification->send();

            // send notification to organizer
            $notification = new \App\Models\Notification();
            $notification->tourId = $tour->id;
            $notification->to = 'users@'.$tour->organizerId;
            $notification->channel = 'webinar@new';
            $notification->type = \App\Models\Notification::INFO;
            $notification->title = "A new webinar has just been registered";
            $notification->content = '<a href="/administrator/tours/'.$tour->id.'/events/webinars/'.$webinar->id.'">'.$webinar->topic.'</a>';
            $notification->save();
            $notification->send();
        }
        
        return redirect('/partner/tours/'.$id.'/events/webinars/'.$webinar->id);
    }

    public function saveEdit($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $booth = DB::table('booth')->find($id);
        $tour = DB::table('tour')->find($booth->tourId);
        $webinarId = $request->webinarId;

        $topic = $request->topic;
        $poster = $request->poster;
        $start = $request->start;
        $end = $request->end;
        $description = $request->description;

        $speakerNos = $request->speakerNos;
        $speakerIds = $request->speakerIds;
        $speakerHonorifics = $request->speakerHonorifics;
        $speakerNames = $request->speakerNames;
        $speakerPositions = $request->speakerPositions;
        $speakerAvatars = $request->speakerAvatars;
        
        $detailTitles = $request->detailTitles;
        $detailDurations = $request->detailDurations;
        $detailSpeakerNos = $request->detailSpeakerNos;
        $detailContents = $request->detailContents;

        $webinar = \App\Models\Webinar::find($webinarId);

        // save file to cloud
        $posterUrl = isset($poster) ? $this->uploadFile($poster, true)->url : $webinar->poster;
        $avatarUrls = [];
        foreach ($speakerNames as $key => $value) {
            $url = null;
            if(isset($speakerAvatars[$key])){
                $file = $speakerAvatars[$key];
                $url = $this->uploadFile($file, true)->url;
            }
            else
            if(isset($speakerIds[$key])){ // get old avatar if exist
                $oldSpeaker = \App\Models\Speaker::find($speakerIds[$key]);
                if(isset($oldSpeaker)){
                    $url = $oldSpeaker->avatar;
                }
            }
            $avatarUrls[$key] = $url;
        }

        // delete old speakers
        $rs = \App\Models\Speaker::where('webinarId', $webinarId)->delete();

        // create details
        $speakers = [];
        foreach ($speakerNos as $key => $value) {
            $name = $speakerNames[$key];
            $avatarUrl = $avatarUrls[$key];
            $honorific = $speakerHonorifics[$key];
            $position = $speakerPositions[$key];

            $speaker = new \App\Models\Speaker();
            $speaker->webinarId = $webinarId;
            $speaker->name = $name;
            $speaker->avatar = isset($avatarUrl) ? $avatarUrl : 'https://res.cloudinary.com/virtual-tour/image/upload/v1634458347/icons/default-avatar_muo2gc.jpg';
            $speaker->honorific = $honorific;
            $speaker->position = $position;
            $speaker->save();
            $speakers[$value] = $speaker;
        }

       
        if(isset($webinar)){
            $webinar->topic = $topic;
            $webinar->poster = $posterUrl;
            $webinar->startAt = $start;
            $webinar->endAt = $end;
            $webinar->description = $description;
            if($profile->id !=  $tour->organizerId){
                $webinar->isConfirmed = null;
            }
            $webinar->save();
        }

        // delete old details
        $details = \App\Models\Webinar_Detail::where('webinarId', $webinarId);
        $details->delete();

        // create details
        foreach ($detailTitles as $key => $value) {
            $detail = new \App\Models\Webinar_Detail();
            $detail->webinarId = $webinar->id;
            $detail->title = $detailTitles[$key];
            $detail->duration = $detailDurations[$key];
            $detail->content = $detailContents[$key];
            $detail->speakerId = $speakers[$detailSpeakerNos[$key]]->id;
            $detail->save();
        }

        if($profile->id !=  $tour->organizerId){
            // send notification to user registered webinar
            $notification = new \App\Models\Notification();
            $notification->tourId = $tour->id;
            $notification->to = 'users@'.$webinar->registrant->id;
            $notification->channel = 'webinar@new';
            $notification->type = \App\Models\Notification::INFO;
            $notification->title = "You have re-registered a webinar";
            $notification->content = '<a href="/partner/tours/'.$tour->id.'/events/webinars/'.$webinar->id.'">'.$webinar->topic.'</a>';
            $notification->save();
            $notification->send();

            // send notification to organizer
            $notification = new \App\Models\Notification();
            $notification->tourId = $tour->id;
            $notification->to = 'users@'.$tour->organizerId;
            $notification->channel = 'webinar@new';
            $notification->type = \App\Models\Notification::INFO;
            $notification->title = "A webinar has just been re-registered";
            $notification->content = '<a href="/administrator/tours/'.$tour->id.'/events/webinars/'.$webinar->id.'">'.$webinar->topic.'</a>';
            $notification->save();
            $notification->send();
        }

        return redirect('/partner/tours/'.$id.'/events/webinars/'.$webinar->id);
    }

    public function saveDelete($id, $webinarId, Request $request)
    {
        $webinar = \App\Models\Webinar::find($webinarId);
        $webinar->isDeleted = true ;
        $webinar->save();
        
        return true;
    }


}
