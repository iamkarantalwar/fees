<?php

namespace App\Http\Controllers;

use App\Fee;
use App\Registration;
use Illuminate\Http\Request;
use \Auth;
use \Hash;
class FeeController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    
    
    public function index()
    {
        return view('admin.fee.index');
    }

  
    public function create(Request $request)
    {
        $id = $request->get('registration_id');
        if ($id != null){
            $registration = Registration::findOrFail($id);
            $fees_paid = 0;
            foreach ($registration->fees as $row) {
                    $fees_paid += $row->payable_amount;
            }
            return view('admin.fee.create',['enquiry'=>$registration,'fees_paid'=>$fees_paid]);
        }
        else{
            return redirect()->back();
        }
    }

  
    public function store(Request $request)
    {
      
        if(Hash::check($request->post('password'),Auth::user()->password))
        {
            $balance = 0.00;
            $reg_id =  $request->post('registration_id');
            
            
            $registration = Registration :: findOrFail($reg_id);
            if(count($registration->fees)>0){
                
              
               $balance =  $registration->fees->last()->pending_amount - $request->post('payable_amount');
               
            }
            else
            {
                $balance = $registration->due_fees - $request->post('payable_amount');

              
            }
            
            if (floatval($balance) >= 0 )
            {
                $fee = new Fee();
                $fee->registration_id = $reg_id;
                $fee->recipt_no = $request->post('recipt_no');
                $fee->payable_amount = $request->post('payable_amount');

                $fee->pending_amount = $balance;
                $fee->save();      
                
                return redirect()->back()->with('success',"Fees Has been submitted");
            }
            else{
                return redirect()->back()->with('danger',"This ammount is not acceptible.");
            }
        }
        else{
            return redirect()->back()->with('danger',"Check the password");
        }
      
    }

   
    public function show(Fee $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function edit(Fee $fee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fee $fee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fee $fee)
    {
        //
    }
}
