<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AssetsController extends Controller
{
    public function index($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $booths = \App\Models\Booth::where('tourId', $tour->id)->get();
        $collect = $request->get('collect');

        $assets = [];
        $types = [];

        if($collect == null){
            $collect = "*";
            $assets = \App\Models\Asset::where([
                    ['tourId','=', $id],
                ])
                ->orderBy('updated_at', "DESC")
                ->get();

            $types = DB::table('asset')
                ->where([
                    ['tourId','=', $id],
                ])
                ->select('type', DB::raw('sum(size) as size'),  DB::raw('count(asset.id) as count'))
                ->groupBy('type')
                ->get();
        }
        else
        if($collect == "*"){
            $assets = \App\Models\Asset::where([
                ['tourId','=', $id],
            ])
            ->orderBy('updated_at', "DESC")
            ->get();

            $types = DB::table('asset')
            ->where([
                ['tourId','=', $id],
            ])
            ->select('type', DB::raw('sum(size) as size'),  DB::raw('count(asset.id) as count'))
            ->groupBy('type')
            ->get();
        }
        else
        if($collect == "tour"){
            $assets = \App\Models\Asset::where([
                ['tourId','=', $id],
                ['boothId','=', null],
            ])
            ->orderBy('updated_at', "DESC")
            ->get();

            $types = DB::table('asset')
                ->where([
                    ['tourId','=', $id],
                    ['boothId','=', null],
                ])
                ->select('type', DB::raw('sum(size) as size'),  DB::raw('count(asset.id) as count'))
                ->groupBy('type')
                ->get();
        }
        else
        if(str_starts_with($collect, "booth:")){
            $boothId = str_replace( "booth:", '', $request);
            $assets = \App\Models\Asset::where([
                ['tourId','=', $id],
                ['boothId','=', $boothId],
            ])
            ->orderBy('updated_at', "DESC")
            ->get();

            $types = DB::table('asset')
                ->where([
                    ['tourId','=', $id],
                    ['boothId','=', $boothId],
                ])
                ->select('type', DB::raw('sum(size) as size'),  DB::raw('count(asset.id) as count'))
                ->groupBy('type')
                ->get();
        }

        return view('administrator.assets.index', [
            'profile' => $profile, 
            'tour'=> $tour,
            'assets'=> $assets,
            'collect'=> $collect,
            'booths'=> $booths,
            'types' => $types
        ]);
    }


    public function object($id, $objectId, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $object = \App\Models\TObject::find($objectId);
        $views = \App\Models\View::with('visitor')->where('objectId', $objectId)->get();
        $interests = \App\Models\Interest::with('visitor')->where('objectId', $objectId)->get();

        return view('administrator.objects.object', [
            'profile' => $profile, 
            'tour'=>$tour,
            'object' => $object,
            'views' => $views,
            'interests' => $interests,
        ]);
    }


    public function saveCreate($id, Request $request)
    {  
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tourId = $id;
        $boothId = $request->input('boothId');
        $type = $request->input('type');
        $source = $request->input('source');
        $file = $request->file;
        $url = $request->input('url');

        $asset = new \App\Models\Asset();
        $asset->tourId = $tourId;
        $asset->ownerId = $profile->id;
        $asset->boothId = $boothId;
        $asset->type = $type;
        $asset->source = $source;
        $asset->url = $url;

        if($source == 'local'){
            $cloud = $this->uploadFile1($request->file('file'));
            $asset->name = $request->file('file')->getClientOriginalName();
            $asset->format = $request->file('file')->getClientOriginalExtension();
            $asset->url = $cloud->url;
            $asset->size = $cloud->bytes;
        }
        else
        if($source == 'link'){
            if(str_starts_with($asset->url, 'https://youtu.be/')){
                $asset->source = 'youtube';
            }
        }
        
        $asset->save();

        return $asset;
    }

    public function saveEditName($id, Request $request)
    {
        $assetId = $request->assetId;
        $name = $request->name;

        $asset = \App\Models\Asset::find($assetId);
        if(isset($asset)){
            $asset->name = $name;
            $asset->save();
            return true;
        }
        return false;
    }

    public function saveDelete($id, $assetId, Request $request)
    {
        $asset = \App\Models\Asset::find($assetId);
        if(isset($asset)){
            $asset->isDeleted = true;
            $asset->save();
            return true;
        }
        return false;
    }

    public function getInfor($id, $assetId, Request $request)
    {
        $asset = \App\Models\Asset::find($assetId);
        $views =  \App\Models\View::where('assetId', $assetId)->get();
        $likes =  \App\Models\Like::where('assetId', $assetId)->get();
        $comments =  \App\Models\Comment::with('visitor')->where('assetId', $assetId)->get();

        return json_encode([
            'asset' => $asset,
            'views' => $views,
            'likes' => $likes,
            'comments' => $comments
        ]);
    }
}
