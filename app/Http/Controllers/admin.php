<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admin extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
        $this->user =  \Auth::user();
    }
    //
    public function index()
    {
        return view('admin.dashboard');
    }
}
