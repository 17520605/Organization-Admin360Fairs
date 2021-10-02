<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminEventController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $tours = DB::table('360tool_tour')->where('user_id', '=', $userId)->get();

        if(count($tours) == 0){
            $tour = DB::table('360tool_tour')->insert([
                'name' => 'First Tour',
                'user_id' => $userId
            ]);

            $tours = DB::table('360tool_tour')->where('user_id', '=', $userId)->get();
        }

        return view('index', ['tours'=>$tours]);
    }
}
