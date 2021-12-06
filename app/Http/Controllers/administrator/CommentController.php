<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function showComment($id, Request $request)
    {

        $tour = DB::table('tour')->find($id);
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $commentId = $request->commentId;

        $comment = \App\Models\Comment::find($commentId);
        if(isset($comment)){
            $comment->isHidden = false;
            $comment->save();
            return true;
        }
        return false;
    }

    public function hideComment($id, Request $request)
    {

        $tour = DB::table('tour')->find($id);
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $commentId = $request->commentId;

        $comment = \App\Models\Comment::find($commentId);
        if(isset($comment)){
            $comment->isHidden = true;
            $comment->save();
            return true;
        }
        return false;
    }
}
