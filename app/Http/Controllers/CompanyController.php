<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return view('companies.index');
    }
    public function add()
    {
        return view('companies.add');
    }
    public function edit()
    {
        return view('companies.edit');
    }
}
