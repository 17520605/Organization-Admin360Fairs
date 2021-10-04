<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return view('company.index');
    }
    public function add()
    {
        return view('company.add');
    }
    public function edit()
    {
        return view('company.edit');
    }
}
