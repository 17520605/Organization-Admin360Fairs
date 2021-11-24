<?php

namespace App\Http\Controllers\partner;

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
        return view('partner.notification.index', ['profile' => $profile, 'tour'=> $tour]);
    }

    public function saveCreate($id, Request $request)
    {
        $group = $request->group;
        $channel = $request->channel;

        $data = new \stdClass();
        $data->subject = $request->subject;
        $data->content =  $request->content;
        
        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger($group, $channel, json_encode($data));

        return true;
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
}
