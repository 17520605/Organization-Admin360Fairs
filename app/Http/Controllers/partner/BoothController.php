<?php

namespace App\Http\Controllers\partner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BoothController extends Controller
{
    
    public function index($id, Request $request)
    {
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();


        $booth = \App\Models\Booth::with('owner')->find($id);
        $tour = DB::table('tour')->find($booth->tourId);
        $scene = DB::table('scene')->find($booth->sceneId);
        $panoramas = [];
        $objects = [];
        if($scene != null){
            $panoramas = \App\Models\Panorama::with('asset')
                ->where([
                    ['sceneId', '=', $scene->id],
                    ['isDeleted', '=', false]
                ])->get();
            $objects = DB::table('asset')
                ->join('hotspot', 'asset.id', '=', 'hotspot.assetId')
                ->join('panorama', 'hotspot.panoramaId', '=', 'panorama.id')
                ->where([
                    ['hotspot.isDeleted', '=', false],
                    ['panorama.sceneId', '=', $scene->id],
                    ['panorama.isDeleted', '=', false],
                    ['asset.id', '!=', null],
                    ['asset.isDeleted', '=', false],
                ])
                ->select('asset.*')
                ->distinct()
                ->get();
            foreach ($objects as $object) {
                $viewCount = \App\Models\View::where('assetId', $object->id)->count();
                $likeCount = \App\Models\Like::where('assetId',  $object->id)->count();
                $commentCount = \App\Models\Comment::where([
                        ['assetId', '=', $object->id],
                        ['isHidden', '=', false],
                    ])->count();
                $object->viewCount = $viewCount;
                $object->likeCount = $likeCount;
                $object->commentCount = $commentCount;
            }
        }

        $assets = \App\Models\Asset::where([
                ['tourId','=', $id],
                ['boothId','=', $booth->id],
            ])
            ->orderBy('updated_at', "DESC")
            ->get();

        $types = DB::table('asset')
            ->where([
                ['tourId','=', $id],
                ['boothId','=', $booth->id],
            ])
            ->select('type', DB::raw('sum(size) as size'),  DB::raw('count(asset.id) as count'))
            ->groupBy('type')
            ->get();
        
        $views = \App\Models\View::where('boothId', $id)->get();
        $likes = \App\Models\Like::where('boothId', $id)->get();
        $comments = \App\Models\Comment::with('visitor')->where('boothId', $id)->orderBy('created_at', 'DESC')->get();

        return view('partner.booth.index', [
            'user' => $user,
            'profile' => $profile, 
            'tour'=> $tour, 
            'booth' => $booth,
            'panoramas' => $panoramas,
            'scene' => $scene,
            'assets' => $assets,
            'types' => $types,
            'views'=>$views,
            'likes'=>$likes,
            'comments'=>$comments,
            'objects'=>$objects,
        ]);

    }

    public function saveEdit($id, Request $request)
    {
        $tour = DB::table('tour')->find($id);

        $boothId = $request->boothId;
        $name = $request->name;
        $description = $request->description;
        $logo = $request->logo;

        $booth = \App\Models\Booth::find($boothId); 
        $booth->name = $name;
        $booth->description =  $description;
        $booth->logo =  $logo;
        $booth->isConfirmed = NULL;
        $booth->save();

        return back();
    }

    public function saveRequest($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $booth = \App\Models\Booth::where([
            ['id', '=', $id],
            ['isDeleted', '=', false],
        ])->first();
        $tour = DB::table('tour')->find($booth->tourId);

        if(!isset($booth)){
            return json_encode([
                "success" => false,
                'error' => "Booth does not exist or has been deleted.",
            ]);
        }

        if($booth->isWaitingApproval == true){
            return json_encode([
                "success" => false,
                'error' => "Approval request already exists.",
            ]);
        }

        $booth->isConfirmed = null;
        $booth->isWaitingApproval = true;
        $booth->save();
        
        if($profile->id != $tour->organizerId){
            // send notification to user send request
            $notification = new \App\Models\Notification();
            $notification->tourId = $tour->id;
            $notification->isSeen = true;
            $notification->to = 'users@'.$booth->owner->id;
            $notification->channel = 'booth@request';
            $notification->type = \App\Models\Notification::INFO;
            $notification->title = "You have requested approval for booth";
            $notification->content = '<a href="/partner/booths/'.$booth->id.'">'.$booth->name.'</a>';
            $notification->detail = json_encode(["booth" => $booth]);
            $notification->save();

            // send notification to organizer
            $notification = new \App\Models\Notification();
            $notification->tourId = $tour->id;
            $notification->to = 'users@'.$tour->organizerId;
            $notification->channel = 'booth@request';
            $notification->type = \App\Models\Notification::INFO;
            $notification->title = "You have a approval request for booth";
            $notification->content = '<a href="/administrator/tours/'.$booth->tourId.'/booths/'.$booth->id.'">'.$booth->name.'</a>';
            $notification->detail = json_encode(["booth" => $booth]);
            $notification->save();
            $notification->send();
        }

        return json_encode([
            'success' => true,
        ]);
    }

    public function saveCancel($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $booth = \App\Models\Booth::find($id);
        $tour = DB::table('tour')->find($booth->tourId);

        if($booth->isWaitingApproval == true && $booth->isConfirmed == null){
            $booth->isWaitingApproval = false;
            $booth->isConfirmed = null;
            $booth->save();

            if($profile->id != $tour->organizerId){
                // send notification to user send request
                $notification = new \App\Models\Notification();
                $notification->tourId = $tour->id;
                $notification->isSeen = true;
                $notification->to = 'users@'.$booth->owner->id;
                $notification->channel = 'booth@cancel';
                $notification->type = \App\Models\Notification::INFO;
                $notification->title = "You have cancel approval request for booth.";
                $notification->content = '<a href="/partner/booths/'.$booth->id.'">'.$booth->name.'</a>';
                $notification->detail = json_encode(["booth" => $booth]);
                $notification->save();
    
                // send notification to organizer
                $notification = new \App\Models\Notification();
                $notification->tourId = $tour->id;
                $notification->to = 'users@'.$tour->organizerId;
                $notification->channel = 'booth@cancel';
                $notification->type = \App\Models\Notification::INFO;
                $notification->title = "A approval request for booth has canceled.";
                $notification->content = '<a href="/administrator/tours/'.$tour->id.'/booths/'.$booth->id.'">'.$booth->name.'</a>';
                $notification->detail = json_encode(["booth" => $booth]);
                $notification->save();
                $notification->send();
            }

            return json_encode([
                'success' => true,
            ]);
        }
        else{
            return json_encode([
                'success' => false,
                'error' => "Can't cancel. The approval request has been canceled or processed",
            ]);
        }
    }

    public function saveAddObjects($id, Request $request)
    {
        $objectIds = $request->objectIds;
        $boothId = $request->boothId;

        foreach ($objectIds as $objectId) {
            $booth_object = new \App\Models\Booth_Object();
            $booth_object->boothId = $boothId;
            $booth_object->objectId = $objectId;
            $booth_object->save();
        }

        return back();
    }
}
