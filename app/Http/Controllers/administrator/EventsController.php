<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Support\Entry;
use MacsiDigital\Zoom\Facades\Zoom;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function schedule($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $tag = $request->get('tag');

        $all_dates = DB::table('webinar')->where([
                ['tourId', '=', $id],
                ['isDeleted', '=', false],
                ['isConfirmed', '=', true],
            ])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(DB::raw('Date(startAt) as date'));
        foreach ($all_dates as $date) {
            $webinars = \App\Models\Webinar::with('details')
                ->where([
                    ['tourId', '=', $id],
                    ['isDeleted', '=', false],
                    ['isConfirmed', '=', true],
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
                ['isConfirmed', '=', true],
            ])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(DB::raw('Date(startAt) as date'));
        foreach ($my_dates as $date) {
            $webinars = \App\Models\Webinar::with('details')
                ->where([
                    ['tourId', '=', $id],
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


        return view('administrator.events.schedule', [
            'profile' => $profile , 
            'tour'=>$tour, 
            'all_dates' => $all_dates,
            'my_dates' => $my_dates,
            'webinars'=>$webinars, 
            'speakers' => $speakers,
            'tag' => $tag
        ]);
    }

    public function requests($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $tag = $request->get('tag');

        $webinars = \App\Models\Webinar::with('details','registrant')
            ->where([
                ['tourId', '=', $id],
                ['isDeleted', '=', false],
                ['isWaitingApproval', '=', true],
            ])
            ->orderBy('startAt', 'ASC')
            ->get();

        $speakers = DB::table('tour_speaker')
            ->join('profile', 'profile.id', '=', 'tour_speaker.speakerId')
            ->where('tour_speaker.tourId', $id)
            ->select('profile.*')
            ->get();

        return view('administrator.events.request', [
            'profile' => $profile , 
            'tour'=>$tour, 
            'webinars'=>$webinars, 
            'speakers' => $speakers,
            'tag' => $tag
        ]);
    }

    public function webinars($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $webinars = \App\Models\Webinar::with('details','registrant')
            ->where([
                ['tourId', '=',  $tour->id],
                ['boothId', '=',  null],
                ['isDeleted', '=', false],
            ])
            ->orderBy('startAt', 'ASC')
            ->get();

        return view('administrator.events.webinars', [
            'profile' => $profile , 
            'tour'=>$tour,
            'webinars'=>$webinars, 
        ]);
    }

    public function webinar($id, $webinarId, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $webinar = \App\Models\Webinar::with('details', 'speakers', 'registrant')
            ->where('id',$webinarId)
            ->first();

        return view('administrator.events.webinar', [
            'profile' => $profile, 
            'tour'=>$tour,
            'webinar' => $webinar, 
        ]);
    }

    public function create($id, Request $request)
    {     
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        return view('administrator.events.create', [
            'profile' => $profile , 
            'tour'=>$tour
        ]);
    }

    public function edit($id, $webinarId, Request $request)
    {     
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $webinar = \App\Models\Webinar::with('details', 'speakers', 'registrant')
            ->where('id',$webinarId)
            ->first();

        return view('administrator.events.edit', [
            'profile' => $profile , 
            'tour'=>$tour,
            'webinar' => $webinar
        ]);
    }

    public function saveCreate($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $topic = $request->topic;
        $poster = $request->poster;
        $start = $request->start;
        $end = $request->end;
        $zoom = $request->zoom;
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
        $posterUrl = 'https://res.cloudinary.com/virtual-tour/image/upload/v1637651914/Background/webinar-default-poster_f23c8z.jpg';
        
        if(isset($poster)){
            $res = $this->uploadFile1($poster, true);
            $asset = new \App\Models\Asset();
            $asset->type = 'image';
            $asset->target = 'webinar';
            $asset->url = $res->url;
            $asset->url = $res->url;
            $asset->name = $poster->getClientOriginalName();
            $asset->format = $poster->getClientOriginalExtension();
            $asset->size = $res->bytes;
            $asset->save();

            $posterUrl = $asset->url;
        }
    
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
        $webinar->zoom = $zoom;
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
        
        return redirect('/administrator/tours/'.$id.'/events/webinars/'.$webinar->id);
    }

    public function saveEdit($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $webinarId = $request->webinarId;

        $topic = $request->topic;
        $poster = $request->poster;
        $start = $request->start;
        $end = $request->end;
        $zoom = $request->zoom;
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
        $posterUrl = $webinar->poster; 
        if(isset($poster)){
            $res = $this->uploadFile1($poster, true);
            $asset = new \App\Models\Asset();
            $asset->type = 'image';
            $asset->target = 'webinar';
            $asset->url = $res->url;
            $asset->url = $res->url;
            $asset->name = $poster->getClientOriginalName();
            $asset->format = $poster->getClientOriginalExtension();
            $asset->size = $res->bytes;
            $asset->save();

            $posterUrl = $asset->url;
        }
        
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
            $webinar->zoom = $zoom;
            $webinar->description = $description;
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

        return redirect('/administrator/tours/'.$id.'/events/webinars/'.$webinar->id);
    }

    public function saveDelete($id, $webinarId, Request $request)
    {
        $webinar = \App\Models\Webinar::find($webinarId);
        $webinar->isDeleted = true ;
        $webinar->save();
        
        return true;
    }

    public function saveApprove($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $webinarId = $request->webinarId;
        $webinar = \App\Models\Webinar::where([
            ['id', '=', $webinarId],
            ['isDeleted', '=', false],
        ])->first();

        if(!isset($webinar)){
            return json_encode([
                "success" => false,
                'error' => "Webinar does not exist or has been deleted.",
            ]);
        }

        if($webinar->isWaitingApproval == false){
            return json_encode([
                "success" => false,
                'error' => "The approval request has already been canceled or processed.",
            ]);
        }

        $webinar->isConfirmed = true;
        $webinar->isWaitingApproval = false;
        $webinar->save();
        
        // send notification to user registered webinar
        $notification = new \App\Models\Notification();
        $notification->tourId = $tour->id;
        $notification->to = 'users@'.$webinar->registrant->id;
        $notification->channel = 'webinar@approve';
        $notification->type = \App\Models\Notification::SUCCESS;
        $notification->title = "Your webinar registration was approved";
        $notification->content = '<a href="/partner/booths/'.$webinar->boothId.'/events/webinars/'.$webinar->id.'">'.$webinar->topic.'</a>';
        $notification->detail = json_encode(["webinar" => $webinar]);
        $notification->save();
        $notification->send();

        // send notification to organizer
        $notification = new \App\Models\Notification();
        $notification->tourId = $tour->id;
        $notification->isSeen = true;
        $notification->to = 'users@'.$tour->organizerId;
        $notification->channel = 'webinar@approve';
        $notification->type = \App\Models\Notification::SUCCESS;
        $notification->title = "You approved a webinar registration";
        $notification->content = '<a href="/administrator/tours/'.$webinar->tourId.'/events/webinars/'.$webinar->id.'">'.$webinar->topic.'</a>';
        $notification->detail = json_encode(["webinar" => $webinar]);
        $notification->save();

        return json_encode([
            "success" => true,
        ]);
    }
    
    public function saveReject($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $webinarId = $request->webinarId;
        $message = $request->message;
        $webinar = \App\Models\Webinar::where([
            ['id', '=', $webinarId],
            ['isDeleted', '=', false],
        ])->first();

        if(!isset($webinar)){
            return json_encode([
                "success" => false,
                'error' => "Webinar does not exist or has been deleted.",
            ]);
        }

        if($webinar->isWaitingApproval == false){
            return json_encode([
                "success" => false,
                'error' => "The approval request has already been canceled or processed.",
            ]);
        }

        $webinar->isConfirmed = false;
        $webinar->isWaitingApproval = false;
        $webinar->save();
        
        // send notification to user registered webinar
        $notification = new \App\Models\Notification();
        $notification->tourId = $tour->id;
        $notification->to = 'users@'.$webinar->registrant->id;
        $notification->channel = 'webinar@reject';
        $notification->type = \App\Models\Notification::WARNING;
        $notification->title = "Your webinar registration was rejected";
        $notification->content = '<a href="/partner/booths/'.$webinar->boothId.'/events/webinars/'.$webinar->id.'">'.$webinar->topic.'</a>';
        $notification->detail = json_encode(["message" => $message]);
        $notification->save();
        $notification->send();

        // send notification to organizer
        $notification = new \App\Models\Notification();
        $notification->tourId = $tour->id;
        $notification->isSeen = true;
        $notification->to = 'users@'.$tour->organizerId;
        $notification->channel = 'webinar@new';
        $notification->type = \App\Models\Notification::WARNING;
        $notification->title = "You rejected a webinar registration";
        $notification->content = '<a href="/administrator/tours/'.$webinar->tourId.'/events/webinars/'.$webinar->id.'">'.$webinar->topic.'</a>';
        $notification->detail = json_encode(["webinar" => $webinar]);
        $notification->save();

        return json_encode([
            "success" => true,
        ]);
    }

    public function saveReedit($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $webinarId = $request->webinarId;
        $webinar = \App\Models\Webinar::where([
            ['id', '=', $webinarId],
            ['isDeleted', '=', false],
        ])->first();


        if(!isset($webinar)){
            return json_encode([
                "success" => false,
                'error' => "Webinar does not exist or has been deleted.",
            ]);
        }

        $webinar->isConfirmed = null;
        $webinar->isWaitingApproval = false;
        $webinar->save();
        
        // send notification to user request 
        $notification = new \App\Models\Notification();
        $notification->tourId = $tour->id;
        $notification->to = 'users@'.$webinar->registrant->id;
        $notification->channel = 'webinar@reedit';
        $notification->type = \App\Models\Notification::INFO;
        $notification->title = "You have a request for re-edit webinar";
        $notification->content = '<a href="/partner/booths/'.$webinar->boothId.'/events/webinars/'.$webinar->id.'">'.$webinar->topic.'</a>';
        $notification->detail = json_encode(["webinar" => $webinar]);
        $notification->save();
        $notification->send();

        // send notification to organizer
        $notification = new \App\Models\Notification();
        $notification->tourId = $tour->id;
        $notification->isSeen = true;
        $notification->to = 'users@'.$tour->organizerId;
        $notification->channel = 'webinar@reedit';
        $notification->type = \App\Models\Notification::INFO;
        $notification->title = "You have request re-edit for a webinar";;
        $notification->content = '<a href="/administrator/tours/'.$webinar->tourId.'/events/webinars/'.$webinar->id.'">'.$webinar->topic.'</a>';
        $notification->detail = json_encode(["webinar" => $webinar]);
        $notification->save();

        return json_encode([
            "success" => true,
        ]);
    }
}
