<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $profile = null;
            
            if($user != null){
                $profile = DB::table('profile')->where('userId', $user->id)->first();
            }
            
            $parameters = Route::getCurrentRoute()->parameters();
            $role = explode('/', Route::getCurrentRoute()->uri)[0];

            if($role == 'administrator' && $user->level < User::LEVEL_TOURADMIN){
                return response(view('others.permission_denied'));
            }
            else
            if($role == 'partner' && $user->level < User::LEVEL_PARTICIPANT){
                return response(view('others.permission_denied'));
            }
            else
            if($role == 'speaker' && $user->level < User::LEVEL_SPEAKER){
                return response(view('others.permission_denied'));
            }

            if(array_key_exists('id', $parameters)){
                $tourId = Route::getCurrentRoute()->parameters()['id'];
  
                if($tourId != null){ 
                    if($profile != null){
                        $tour = DB::table('tour')->find($tourId);
                        if($tour != null){
                            if($role == 'administrator'){
                                if($tour->organizerId == $profile->id){
                                    return $next($request);
                                }
                                else{
                                    return response(view('others.permission_denied'));
                                }
                            } 
                            else
                            if($role == 'partner'){
                                $tour_partner = DB::table('tour_partner')
                                ->where([
                                    ['tour_partner.tourId', '=', $tourId],
                                    ['tour_partner.partnerId', '=', $profile->id],
                                    ['tour_partner.status', '!=', \App\Models\Tour_Partner::UNCONFIRMED]
                                ])
                                ->first();
    
                                if($tour_partner != null){
                                    return $next($request);
                                }else{
                                    return response(view('others.permission_denied'));
                                }
                            }
                            else
                            if($role == 'speaker'){
                                $tour_speaker = DB::table('tour_speaker')
                                ->where([
                                    ['tour_speaker.tourId', '=', $tourId],
                                    ['tour_speaker.speakerId', '=', $profile->id],
                                    ['tour_speaker.status', '!=', \App\Models\Tour_Speaker::UNCONFIRMED]
                                ])
                                ->first();
    
                                if($tour_speaker != null){
                                    return $next($request);
                                }else{
                                    return response(view('others.permission_denied'));
                                }
                            }
                        }
                    }
                }
            }

            return $next($request);
        });
    }

    public function uploadFile($file, $isUsed = false)
    {   
        $path = Storage::disk('temp')->putFile('/', $file);
        $res = cloudinary()->upload(Storage::disk('temp')->path($file->hashName()), [
            'resource_type' => 'auto'
        ])->getResponse();
        
        // delete file
        $path = Storage::disk('temp')->delete($path);

        $resObj = json_decode(json_encode($res));

        // save asset
        $asset = new \App\Models\Asset();
        $asset->name = $file->getClientOriginalName();
        $asset->url = $resObj->url;
        $asset->format = $file->getClientOriginalExtension();
        $asset->size = $resObj->bytes;
        $asset->isUsed = $isUsed;
        $asset->save();

        return $resObj;
    }

    public function uploadFile1($file)
    {   
        $path = Storage::disk('temp')->putFile('/', $file);
        $res = cloudinary()->upload(Storage::disk('temp')->path($file->hashName()), [
            'resource_type' => 'auto'
        ])->getResponse();
        
        // delete file
        $path = Storage::disk('temp')->delete($path);

        $resObj = json_decode(json_encode($res));
        return $resObj;
    }
}
