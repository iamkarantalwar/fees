<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registration;
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
        $total_students = Registration::all()->count();
        $done_fees = 0;
        foreach(Registration::all() as $registration){
                $last_fees = $registration->fees->last();
               
                if($last_fees->pending_amount == 0){
                    $done_fees += 1;
                }
        }
       
        $pending_fees = $total_students - $done_fees;

        return view('admin.dashboard')->with(['total'=>$total_students,
                                              'pending'=>$pending_fees,
                                              'done'=>$done_fees]);
    }
}
