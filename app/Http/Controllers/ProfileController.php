<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = DB::table('profile')->where('userId', $user->id)->first();
        
        return view('profile.index', compact('profile'));
    }
    public function saveEdit(Request $request)
    {
        $profileId = $request->id;
        $profile = \App\Models\Profile::find($profileId);
        if($profile != null)
        {
            $profile->name = $request->name;
            $profile->contact = $request->contact;
            $profile->address = $request->address;
            $profile->website = $request->website;
            $profile->facebook = $request->facebook;
            $profile->youtube = $request->youtube;
            $profile->type = $request->type;
            $profile->save();
        }
        return back();
    }
    public function saveAvatar(Request $request)
    {
        $profileId = $request->id;
        $profile = \App\Models\Profile::find($profileId);
        if($profile != null)
        {
            $profile->avatar = $request->avatar;
            $profile->save();
        }
        return back();
    }
    public function deleteCv(Request $request)
    {
        $profileId = $request->id;
        $url = $request->url;
        $profile = \App\Models\Profile::find($profileId);
        if($profile != null)
        {
            $profile->profile = $url ;
            $profile->save();
        }
        return true;
    }

    public function saveCv(Request $request)
    {
        $profileId = $request->id;
        $url = $request->url;
        $profile = \App\Models\Profile::find($profileId);
        if($profile != null)
        {
            $profile->profile = $url;
            $profile->save();
        }
        return true;
    }

}
