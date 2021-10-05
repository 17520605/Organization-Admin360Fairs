<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ObjectsController extends Controller
{
    public function index($id)
    {
        $tour = DB::table('tour')->find($id);
        return view('tour.index', ['user' => Auth::user(), 'tour'=>$tour]);
    }

    public function images ($id, Request $request)
    {
        $tour = DB::table('tour')->find($id);
        return view('objects.images', ['user' => Auth::user(), 'tour'=>$tour]);
    }
}
