<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminEventController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function tour()
    {
        return view('tour:index');
    }
    public function company()
    {
        return view('companies:index');
    }
    public function booths()
    {
        return view('booths:index');
    }
    public function mail()
    {
        return view('index');
    }
}
