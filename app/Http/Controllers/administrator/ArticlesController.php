<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Support\Entry;
use MacsiDigital\Zoom\Facades\Zoom;
use Carbon\Carbon;

class ArticlesController extends Controller
{
    public function index($id, Request $request)
    {   
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $articles = \App\Models\Article::where('tourId', $id)->get();
        return view('administrator.articles.index', [
            'articles'=> $articles,
            'profile' => $profile , 
            'tour'=>$tour, 
        ]);
    }

    public function create($id, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        return view('administrator.articles.create')->with([
            'profile' => $profile, 
            'tour'=>$tour, 
        ]);
    }

    public function saveCreate($id, Request $request)
    {
        $tourId = $id;
        $userId = Auth::user()->id;
        $title = $request->input('title');
        $slug = $request->input('slug');
        $shortDescription = $request->input('short_description');
        $content = $request->input('content');
        $file =  $request->file('files');
        $isPublic = $request->input('public');
        $author = $request->input('author');
        $banner = 'https://res.cloudinary.com/virtual-tour/image/upload/v1637651914/Background/webinar-default-poster_f23c8z.jpg';
        
        if(isset($file))
        {
            $res = $this->uploadFile1($file,true);
            $banner = $res->url;
        }

        $article = new \App\Models\Article();
        
        $article->title = $title;
        $article->slug = $slug;
        $article->banner =  $banner;
        $article->shortDescription = $shortDescription;
        $article->content = $content;
        $article->author = $author;
        $article->type = 'tour';
        $article->userId = $userId;
        $article->tourId = $tourId;
        $article->isPublic = isset($isPublic);
        $article->save();

        return redirect('/administrator/tours/'.$id.'/articles');

    }

    public function edit($id, $articleId, Request $request)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);

        $article = \App\Models\Article::where('id', $articleId)->first();
        return view('administrator.articles.edit')->with([
            'article' => $article,
            'profile' => $profile, 
            'tour'=>$tour, 
        ]);
    }

    public function saveEdit($id, $articleId,  Request $request)
    {
        $tourId = $id;
        $userId = Auth::user()->id;
        $article = \App\Models\Article::where('id', $articleId)->first();
        $title = $request->input('title');
        $slug = $request->input('slug');
        $shortDescription = $request->input('short_description');
        $content = $request->input('content');
        $isPublic = $request->input('public');
        $author = $request->input('author');
        $changedFiles = $request->input('changedFiles');
        
        if($article){
            $banner = $article->banner;
            if($changedFiles == "1"){
                $file = $request->file('file');
                if(isset($file))
                {
                    $res = $this->uploadFile($file,true);
                    $banner = $res->url;
                }
                else{
                    $banner = 'https://res.cloudinary.com/virtual-tour/image/upload/v1637651914/Background/webinar-default-poster_f23c8z.jpg';
                }
            }

            $article->title = $title;
            $article->slug = $slug;
            $article->banner =  $banner;
            $article->shortDescription = $shortDescription;
            $article->content = $content;
            $article->author = $author;
            $article->type = 'tour';
            $article->userId = $userId;
            $article->tourId = $tourId;
            $article->isPublic = isset($isPublic);
            $article->save();

        }
        return redirect('/administrator/tours/'.$id.'/articles');
    }

    public function toggleVisiable($id, $articleId, Request $request)
    {
        $article = \App\Models\Article::where('id', $articleId)->first();
        if(isset($article)){
            $article->isPublic = !$article->isPublic;
            $article->save();
            return [
                'success' => true,
                'isPublic' => $article->isPublic,
            ];
        }
        else{
            return [
                'success' => false,
                'errors' => 'Thao tác thát bại'
            ]; 
        }
    }


    public function delete($id, $articleId, Request $request)
    {
        $article = \App\Models\Article::where('id', $articleId,)->first();
        if(isset($article)){
            $article->delete();
            return [
                'success' => true
            ]; 
        }
        else{
            return [
                'success' => false,
                'errors' => 'Xóa thất bại'
            ]; 
        }
    }
}
