<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Pusher\Pusher;
use \stdClass;

class SettingsController extends Controller
{
    public function index($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        return view('administrator.settings.index', [
            'profile' => $profile, 
            'tour'=> $tour,
        ]);
    }
    public function saveConfigsColor(Request $request)
    {
        $tourId = $request->id;
        $tour = \App\Models\Tour::find($tourId);
        if($tour != null)
        {
            $tour->color1 =$request->color1;
            $tour->color2 =$request->color2;
            $tour->color3 =$request->color3;
            $tour->color4 =$request->color4;
            $tour->save();
        }
        return back();
    }

}
