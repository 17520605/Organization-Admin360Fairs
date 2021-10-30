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


class EventsController extends Controller
{
    public function webinars($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $tag = $request->get('tag');

        $all_dates = DB::table('webinar')->where([
                ['tourId', '=', $id],
                ['isDeleted', '=', false]
            ])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(DB::raw('Date(startAt) as date'));
        foreach ($all_dates as $date) {
            $webinars = \App\Models\Webinar::with('details')
                ->where([
                    ['tourId', '=', $id],
                    ['isDeleted', '=', false],
                ])
                ->whereRaw("Date(startAt) = ?", array($date->date))
                ->orderBy('startAt', 'ASC')
                ->get();
            $date->webinars = $webinars;
        }

        $my_dates = DB::table('webinar')
            ->join('webinar_detail', 'webinar.id', '=', 'webinar_detail.webinarId')
            ->where([
                ['tourId', '=', $id],
                ['isDeleted', '=', false],
                ['webinar_detail.speakerId', '=', $profile->id],
            ])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(DB::raw('Date(startAt) as date'));
        foreach ($my_dates as $date) {
            $webinars = \App\Models\Webinar::with('details')
                ->where([
                    ['tourId', '=', $id],
                    ['isDeleted', '=', false],
                ])
                ->whereHas('details', function ($q) use($profile){
                    $q->where('speakerId', '=', $profile->id);
                })
                ->whereRaw("Date(startAt) = ?", array($date->date))
                ->orderBy('startAt', 'ASC')
                ->get();
            $date->webinars = $webinars;
        }

        return view('speaker.events.webinars', [
            'profile' => $profile,
            'tour'=>$tour,
            'all_dates' => $all_dates,
            'my_dates' => $my_dates,
            'tag' => $tag
        ]);
    }

    public function webinar($id, $webinarId, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $tab = $request->get('tab');

        $webinar = \App\Models\Webinar::with('details')
            ->where('id',$webinarId)
            ->first();
        foreach ($webinar->details as $detail) {
            $detail->speaker = DB::table('profile')->find($detail->speakerId);

            $documents = \App\Models\Document::with('owner')
                ->whereHas('webinar_detail_documents', function ($q) use($detail){
                    $q->where('webinarDetailId', $detail->id);
                })
                ->where('isDeleted', false)
                ->get();

            $detail->documents = $documents;
        }

        $documents = \App\Models\Document::where([
            ['ownerId', '=', $profile->id],
            ['isDeleted', '=', false],
        ])
        ->orderBy('created_at','DESC')
        ->get();

        return view('speaker.events.webinar', [
            'profile' => $profile , 
            'tour'=>$tour,
            'webinar' => $webinar, 
            'documents'=> $documents, 
            'tab' => $tab
        ]);
    }

    public function uploadDocuments($id, $webinarId, Request $request)
    {
        $files = $request->files;
        $webinarDetailId = $request->webinarDetailId;

        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $documents = array();

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
                $document->isUsed = true;
                $document->ownerId = $profile->id;
                $document->save();
                array_push($documents, $document);

                $webinar_detail_document = new \App\Models\Webinar_Detail_Document();
                $webinar_detail_document->webinarDetailId = $webinarDetailId;
                $webinar_detail_document->documentId = $document->id;
                $webinar_detail_document->save();
               
            }
        }

        return response(json_encode($documents));
    }

    public function chooseDocuments($id, $webinarId, Request $request)
    {
        $documentIds = $request->documentIds;
        $webinarDetailId = $request->webinarDetailId;

        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $documents = array();

        foreach ($documentIds as $documentId) {
            $document = \App\Models\Document::find($documentId);
            if(isset($document)){
                $document->isUsed = true;
                $document->save();
            }

            $webinar_detail_document = new \App\Models\Webinar_Detail_Document();
            $webinar_detail_document->webinarDetailId = $webinarDetailId;
            $webinar_detail_document->documentId =  $documentId;
            $webinar_detail_document->save();
        }

        return response(json_encode($documents));
    }


    public function deleteDocument($id, $webinarId, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();

        $webinarDetailId = $request->webinarDetailId;
        $documentId = $request->documentId;


        $webinar_detail_document = \App\Models\Webinar_Detail_Document::where([
            ['webinarDetailId', '=', $webinarDetailId],
            ['documentId', '=', $documentId],
        ])->first();

        if($webinar_detail_document != null){
            $webinar_detail_document->delete();
        }

        return true;
    }

    public function saveEditWebinarDetail($id, $webinarId, Request $request)
    {
        $webinarDetailId = $request->webinarDetailId;
        $title = $request->title;
        $content = $request->content;

        $webinar_detail = \App\Models\Webinar_Detail::find( $webinarDetailId );
        if($webinar_detail != null){
            $webinar_detail->title = $title;
            $webinar_detail->content = $content;
            $webinar_detail->save();

            return true;
        }

        return false;
    }
}
