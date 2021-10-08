<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BoothsController extends Controller
{
    
    public function booths($id)
    {
        $user = Auth::user();
        $tour = DB::table('tour')->find($id);

        return view('booths.booths', ['user' => $user, 'tour'=> $tour]);
    }
}
