<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BoothsController extends Controller
{
    
    public function index($id)
    {
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();

        $tour = DB::table('tour')->find($id);

        $zones = \App\Models\Zone::where('isDeleted', false)->get();

        $groups = \App\Models\Zone::where('isDeleted', false)->get();
        foreach ($groups as $group) {
            $zoneId = $group->id;
            $booths = \App\Models\Booth::whereHas('zone_booths', function ($q) use($zoneId){
                    $q->where('zoneId', '=', $zoneId);
                })->get();

            $group->booths = $booths;
        }

        $freeBooths = \App\Models\Booth::with('owner')->doesntHave('zone_booths')->get();

        $partners = DB::table('tour_partner')
            ->join('profile', 'profile.id', '=', 'tour_partner.partnerId')
            ->where([
                ['tour_partner.tourId', '=', $id],
                ['tour_partner.status', '!=', \App\Models\Tour_Partner::UNCONFIRMED],
            ])
            ->select('profile.*', 'status')
            ->get(); 

        return view('administrator.booths.index', [
            'profile' => $profile, 
            'tour'=> $tour, 
            'zones' => $zones, 
            'groups' => $groups, 
            'freeBooths'=> $freeBooths,
            'partners'=> $partners,
        ]);
    }

    public function request($id)
    {
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();

        $tour = DB::table('tour')->find($id);

        $zones = \App\Models\Zone::where('isDeleted', false)->get();

        $groups = \App\Models\Zone::where('isDeleted', false)->get();
        foreach ($groups as $group) {
            $zoneId = $group->id;
            $booths = \App\Models\Booth::whereHas('zone_booths', function ($q) use($zoneId){
                    $q->where('zoneId', '=', $zoneId);
                })->get();
            $group->booths = $booths;
        }

        $freeBooths = \App\Models\Booth::with('owner')->doesntHave('zone_booths')->get();

        $partners = DB::table('tour_partner')
            ->join('profile', 'profile.id', '=', 'tour_partner.partnerId')
            ->where([
                ['tour_partner.tourId', '=', $id],
                ['tour_partner.status', '!=', \App\Models\Tour_Partner::UNCONFIRMED],
            ])
            ->select('profile.*', 'status')
            ->get(); 

        return view('administrator.booths.request', [
            'profile' => $profile, 
            'tour'=> $tour, 
            'zones' => $zones, 
            'groups' => $groups, 
            'freeBooths'=> $freeBooths,
            'partners'=> $partners,
        ]);
    }

    public function grantOwner($id, Request $request)
    {
        $boothId = $request->boothId;
        $partnerId = $request->partnerId;
        
        $booth = \App\Models\Booth::find($boothId);
        $booth->ownerId = $partnerId;
        $booth->status = \App\Models\Booth::STATUS_INPROCESS;
        $booth->save();

        return back();
    }

    public function changeLogo($id, $boothId, Request $request)
    {
        $logo = $request->logo;
        $booth = \App\Models\Booth::find($boothId);
        $booth->logo =  $logo;
        $booth->save();
        return true;
    }

    public function booth($id, $boothId, Request $request)
    {
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();
        $tour = DB::table('tour')->find($id);

        $booth = \App\Models\Booth::with('owner')->find($boothId);
        $scene = DB::table('scene')->find($booth->sceneId);
        $panoramas = [];
        if($scene != null){
            $panoramas = DB::table('panorama')->where('sceneId', $scene->id)->get();
        }

        $objects = DB::table('object')
            ->join('booth_object', 'booth_object.objectId', '=', 'object.Id')
            ->where('booth_object.boothId', '=', $boothId)
            ->select('object.*')
            ->get();

        $types = DB::table('object')
            ->join('booth_object', 'object.id', '=', 'booth_object.objectId')
            ->where('booth_object.boothId', $boothId)
            ->select('type', DB::raw('sum(size) as size'),  DB::raw('count(object.id) as count'))
            ->groupBy('type')
            ->get();
        
        $views = \App\Models\View::with('visitor')->where('boothId', $boothId)->get();
        $comments = \App\Models\Comment::with('visitor')->where([
            ['boothId', '=', $boothId],
            ['isHidden', '=', false],
        ])->orderBy('created_at', 'DESC')->get();

        return view('administrator.booths.booth', [
            'profile' => $profile, 
            'tour'=> $tour, 
            'booth' => $booth,
            'panoramas' => $panoramas,
            'scene' => $scene,
            'objects' => $objects,
            'types' => $types,
            'views'=>$views,
            'comments'=>$comments
        ]);

    }

    public function saveCreate($id, Request $request)
    {
        $user = Auth::user();
        $tour = DB::table('tour')->find($id);
        $profile = DB::table('profile')->where('userId', $user->id)->first();
        $name = $request->name;
        $zoneId = $request->zoneId;

        $booth = new \App\Models\Booth(); 
        $booth->name =  $name;
        $booth->tourId =  $id;
        $booth->ownerId =  $profile->id;
        $booth->save();

        if(isset($zoneId)){
            $zone_booth = new \App\Models\Zone_Booth();
            $zone_booth->zoneId =  $zoneId;
            $zone_booth->boothId =  $booth->id;
            $zone_booth->save();
        }

        return back();
    }

    public function saveEdit($id, Request $request)
    {
        $tour = DB::table('tour')->find($id);

        $boothId = $request->id;
        $name = $request->name;
        $zoneId = $request->zoneId;

        $booth = \App\Models\Booth::find($boothId); 
        $booth->name =  $name;
        $booth->save();

        $zone_booth = \App\Models\Zone_Booth::where('boothId', $boothId)->first();
        
        if(isset($zoneId) && isset($zone_booth)){ // booth chuyen tu zone nay sang zone khac
            $zone_booth->zoneId =  $zoneId;
            $zone_booth->save();
        }
        else
        if(isset($zoneId) && !isset($zone_booth)){ //booth chuyen vao zone
            $zone_booth = new \App\Models\Zone_Booth();
            $zone_booth->boothId = $boothId;
            $zone_booth->zoneId = $zoneId;
            $zone_booth->save();
        }
        else
        if(isset($zone_booth)){ //booth ra khoi zone
            $zone_booth ->delete();
        }

        return back();
    }

    public function saveDelete($id, $boothId, Request $request)
    {
        $booth = \App\Models\Booth::find($boothId);
        $booth->delete();
        return true;
    }

    public function saveApprove($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $boothId = $request->boothId;
        $booth = \App\Models\Booth::where([
            ['id', '=', $boothId],
            ['isDeleted', '=', false],
        ])->first();

        if(!isset($booth)){
            return json_encode([
                "success" => false,
                'error' => "Booth does not exist or has been deleted.",
            ]);
        }

        if($booth->isWaitingApproval == false){
            return json_encode([
                "success" => false,
                'error' => "The approval request has already been canceled or processed.",
            ]);
        }

        $booth->isConfirmed = true;
        $booth->isWaitingApproval = false;
        $booth->save();
        
        // send notification to user request
        $notification = new \App\Models\Notification();
        $notification->tourId = $tour->id;
        $notification->to = 'users@'.$booth->owner->id;
        $notification->channel = 'booth@approve';
        $notification->type = \App\Models\Notification::SUCCESS;
        $notification->title = "Your request for booth was approved";
        $notification->content = '<a href="/partner/booths/'.$booth->id.'">'.$booth->name.'</a>';
        $notification->detail = json_encode(["booth" => $booth]);
        $notification->save();
        $notification->send();

        // send notification to organizer
        $notification = new \App\Models\Notification();
        $notification->tourId = $tour->id;
        $notification->isSeen = true;
        $notification->to = 'users@'.$tour->organizerId;
        $notification->channel = 'booth@booth';
        $notification->type = \App\Models\Notification::SUCCESS;
        $notification->title = "You approved a booth request";
        $notification->content = '<a href="/administrator/tours/'.$booth->tourId.'/booths/'.$booth->id.'">'.$booth->name.'</a>';
        $notification->detail = json_encode(["booth" => $booth]);
        $notification->save();

        return json_encode([
            "success" => true,
        ]);
    }
    
    public function saveReject($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $message = $request->message;
        $boothId = $request->boothId;
        $booth = \App\Models\Booth::where([
            ['id', '=', $boothId],
            ['isDeleted', '=', false],
        ])->first();

        if(!isset($booth)){
            return json_encode([
                "success" => false,
                'error' => "Booth does not exist or has been deleted.",
            ]);
        }

        if($booth->isWaitingApproval == false){
            return json_encode([
                "success" => false,
                'error' => "The approval request has already been canceled or processed.",
            ]);
        }

        $booth->isConfirmed = false;
        $booth->isWaitingApproval = false;
        $booth->save();
        
        // send notification to user request 
        $notification = new \App\Models\Notification();
        $notification->tourId = $tour->id;
        $notification->to = 'users@'.$booth->ownerId;
        $notification->channel = 'booth@reject';
        $notification->type = \App\Models\Notification::WARNING;
        $notification->title = "Your request for booth was rejected ";
        $notification->content = '<a href="/partner/booths/'.$booth->id.'">'.$booth->name.'</a>';
        $notification->detail = json_encode(["message" => $message]);
        $notification->save();
        $notification->send();

        // send notification to organizer
        $notification = new \App\Models\Notification();
        $notification->tourId = $tour->id;
        $notification->isSeen = true;
        $notification->to = 'users@'.$tour->organizerId;
        $notification->channel = 'booth@reject';
        $notification->type = \App\Models\Notification::WARNING;
        $notification->title = "You rejected a booth request";
        $notification->content = '<a href="/administrator/tours/'.$booth->tourId.'/booths/'.$booth->id.'">'.$booth->name.'</a>';
        $notification->detail = json_encode(["booth" => $booth]);
        $notification->save();

        return json_encode([
            "success" => true,
        ]);
    }

    public function saveReedit($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $boothId = $request->boothId;
        $booth = \App\Models\Booth::where([
            ['id', '=', $boothId],
            ['isDeleted', '=', false],
        ])->first();

        if(!isset($booth)){
            return json_encode([
                "success" => false,
                'error' => "Booth does not exist or has been deleted.",
            ]);
        }

        $booth->isConfirmed = null;
        $booth->isWaitingApproval = false;
        $booth->save();
        
        // send notification to user request 
        $notification = new \App\Models\Notification();
        $notification->tourId = $tour->id;
        $notification->to = 'users@'.$booth->ownerId;
        $notification->channel = 'booth@reedit';
        $notification->type = \App\Models\Notification::INFO;
        $notification->title = "You have a request for re-edit booth";
        $notification->content = '<a href="/partner/booths/'.$booth->id.'">'.$booth->name.'</a>';
        $notification->detail = json_encode(["booth" => $booth]);
        $notification->save();
        $notification->send();

        // send notification to organizer
        $notification = new \App\Models\Notification();
        $notification->tourId = $tour->id;
        $notification->isSeen = true;
        $notification->to = 'users@'.$tour->organizerId;
        $notification->channel = 'booth@reedit';
        $notification->type = \App\Models\Notification::INFO;
        $notification->title = "You requested re-edit a booth";
        $notification->content = '<a href="/administrator/tours/'.$booth->tourId.'/booths/'.$booth->id.'">'.$booth->name.'</a>';
        $notification->detail = json_encode(["booth" => $booth]);
        $notification->save();

        return json_encode([
            "success" => true,
        ]);
    }
}
