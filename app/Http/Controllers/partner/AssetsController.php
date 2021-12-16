<?php

namespace App\Http\Controllers\partner;

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
        $booth = DB::table('booth')->find($id);
        $assets = \App\Models\Asset::where([
            ['boothId','=', $id],
            ['isDeleted','=', false]
        ])
        ->orderBy('updated_at', "DESC")
        ->get();

        $types = DB::table('asset')
            ->where([
                ['boothId','=', $id],
                ['isDeleted','=', false]
            ])
            ->select('type', DB::raw('sum(size) as size'),  DB::raw('count(asset.id) as count'))
            ->groupBy('type')
            ->get();

        return view('partner.assets.index', [
            'profile' => $profile, 
            'booth'=>$booth,
            'assets'=> $assets,
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

        return view('partner.objects.object', [
            'profile' => $profile, 
            'tour'=>$tour,
            'object' => $object,
            'views' => $views,
            'interests' => $interests,
        ]);
    }


    public function saveCreate($id, Request $request)
    {  
        $profile = \App\Models\Profile::where('userId', Auth::id())->first();
        $booth = \App\Models\Booth::find($id);
        $tourId = $booth->tourId;
        $type = $request->input('type');
        $source = $request->input('source');
        $file = $request->file;
        $url = $request->input('url');

        $asset = new \App\Models\Asset();
        $asset->tourId = $tourId;
        $asset->boothId = $booth->id;
        $asset->ownerId = $profile->id;
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
            if(str_starts_with($asset->url, 'https://youtu')){
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
