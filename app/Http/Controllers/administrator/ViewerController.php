<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ViewerController extends Controller
{
    public function index($id)
    {
        $profile = DB::table('profile')->where('userId', Auth::user()->id)->first();
        $tour = DB::table('tour')->find($id);
        $views = \App\Models\View::with('visitor')->where('tourId', $id)->get();
        return view('administrator.viewer.index', ['profile' => $profile, 'tour'=> $tour ,'views'=>$views]);
    }
}
