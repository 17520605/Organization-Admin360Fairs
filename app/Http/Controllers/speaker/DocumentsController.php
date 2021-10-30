<?php

namespace App\Http\Controllers\speaker;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use MacsiDigital\Zoom\Support\Entry;
use MacsiDigital\Zoom\Facades\Zoom;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;


class DocumentsController extends Controller
{
    public function index($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $tab = $request->get('tab');

        $documents = \App\Models\Document::where([
            ['ownerId', '=', $profile->id],
            ['isDeleted', '=', false],
        ])
        ->orderBy('created_at','DESC')
        ->get();
        
        return view('speaker.documents.index', [
            'profile' => $profile,
            'tour'=>$tour,
            'documents'=>$documents,
            'tab' => $tab
        ]);
    }

  
    public function saveCreate($id, Request $request)
    {
        $files = $request->files;

        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();

        if(count($files) > 0){
            foreach ($files as $key => $file) {

                // save file to storage
                $path = Storage::disk('temp')->putFile('/',$request->file($key));
                
                $res = cloudinary()->upload(Storage::disk('temp')->path($request->file($key)->hashName()), [
                    'resource_type' => 'auto'
                ])->getResponse();
                
                // delete file
                $path = Storage::disk('temp')->delete($path);

                $resObj = json_decode(json_encode($res));

                $name = $file->getClientOriginalName();
                $url = $resObj->url;
                $format = $file->getClientOriginalExtension();
                $size = $resObj->bytes;
                
                $document = new \App\Models\Document();
                $document->name =  $name ;
                $document->format = $format;
                $document->size = $size;
                $document->url = $url;
                $document->ownerId = $profile->id;
                $document->save();
            }
        }

        return true;
    }

    public function saveDelete($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();

        $documentId = $request->documentId;
        $document = \App\Models\Document::find($documentId);

        if($document != null){
            $document->isDeleted = true;
            $document->save();
        }

        return true;
    }
}
