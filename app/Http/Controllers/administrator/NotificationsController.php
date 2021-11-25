<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Pusher\Pusher;
use \stdClass;

class NotificationsController extends Controller
{
    public function index($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $notifications = \App\Models\Notification::where([
                ['tourId', '=', $tour->id],
                ['to', '=', 'users@'.$profile->id]
            ])
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('administrator.notifications.index', [
            'profile' => $profile, 
            'tour'=> $tour,
            'notifications'=> $notifications,
        ]);
    }

    public function getAll($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $notifications = \App\Models\Notification::where([
                ['tourId', '=', $id],
                ['to', '=', 'users@'.$profile->id]
            ])->get();

        return $notifications;
    }

    public function getUnseen($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $notifications = \App\Models\Notification::where([
                ['tourId', '=', $id],
                ['to', '=', 'users@'.$profile->id],
                ['isSeen', '=', false]
            ])->get();

        return json_encode($notifications);
    }

    public function setSeen($id, $notificationId, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $notification = \App\Models\Notification::find($notificationId);
        if(isset($notification) && $notification->isSeen == false){
            $notification->isSeen = true;
            $notification->save();
            return true;
        }

        return false;
    }
}
