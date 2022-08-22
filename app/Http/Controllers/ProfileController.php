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
            $profile->description = $request->description;
            $profile->type = $request->type;
            $profile->save();
        }
        return back();
    }

    public function saveConfigsColor(Request $request)
    {
        $profileId = $request->id;
        $profile = \App\Models\Profile::find($profileId);
        if($profile != null)
        {
            $profile->color1 =$request->color1;
            $profile->color2 =$request->color2;
            $profile->color3 =$request->color3;
            $profile->color4 =$request->color4;
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

    public function saveLogo(Request $request)
    {
        $profileId = $request->id;
        $profile = \App\Models\Profile::find($profileId);
        if($profile != null)
        {
            $profile->logo = $request->logo;
            $profile->save();
        }
        return back();
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

    public function saveBackground(Request $request)
    {
        $profileId = $request->id;
        $url = $request->url;
        $profile = \App\Models\Profile::find($profileId);
        if($profile != null)
        {
            $profile->background = $url;
            $profile->save();
        }
        return true;
    }

    public function deleteBackground(Request $request)
    {
        $profileId = $request->id;
        $url = $request->url;
        $profile = \App\Models\Profile::find($profileId);
        if($profile != null)
        {
            $profile->background = $url ;
            $profile->save();
        }
        return true;
    }

    public function deleteVd(Request $request)
    {
        $profileId = $request->id;
        $url = $request->url;
        $profile = \App\Models\Profile::find($profileId);
        if($profile != null)
        {
            $profile->video = $url ;
            $profile->save();
        }
        return true;
    }

    public function saveVd(Request $request)
    {
        $profileId = $request->id;
        $url = $request->url;
        $profile = \App\Models\Profile::find($profileId);
        if($profile != null)
        {
            $profile->video = $url;
            $profile->save();
        }
        return true;
    }

    public function saveEditPopularImages(Request $request)
    {
        $changedFiles = $request->input('changedFiles');
        $profileId = $request->id;
        $profile = \App\Models\Profile::find($profileId);

        $images = json_decode($profile->imagesId);
        for ($i=0; $i < count($changedFiles); $i++) { 
            if($changedFiles[$i] == "1"){
                $file = $request->file('file'.$i+1);
                if(isset($file)){
                    $imageId = $this->uploadFileImagePopular($file,true);
                    $images[$i] = $imageId;
                }
                else{
                    $images[$i] = null;
                }
            }
        }

        $profile->imagesId = json_encode($images);
        $profile->save();
        return back();
    }

}
