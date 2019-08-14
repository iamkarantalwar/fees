<?php

namespace App\Http\Controllers;

use App\Calling;
use Illuminate\Http\Request;
use App\Enquiry;
class CallingController extends Controller
{
   
    public function index()
    {
    
        return view('admin.calling.new');
    }

    
    public function create(Request $request)
    {
        $id = $request->get('enquiry_id');
        if ($id != null){
            $enquiry = Enquiry::findOrFail($id);
            return view('admin.calling.create',['enquiry'=>$enquiry]);
        }
        else{
            return redirect()->back();
        }
       
    }

    public function store(Request $request)
    {
        $call = new Calling();
        $call->status = $request->post('status');
        $call->narration = $request->post('narration');
        $call->enquiry_id = $request->post('enquiry_id');
        $call->save();
        return redirect()->back()->with('success','Call has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Calling  $calling
     * @return \Illuminate\Http\Response
     */
    public function show(Calling $calling)
    {
        return redirect()->back();
    }

    public function edit(Calling $calling)
    {
        return redirect()->back();
    }

  
    public function update(Request $request, Calling $calling)
    {
        $calling->narration = $request->post('narration');
        $calling->status = $request->post('status');
        $calling->save();
        return redirect()->back()->with('primary',"Call has been updated");
    }

   
    public function destroy(Calling $calling)
    {
        $calling->delete();
        return redirect()->back()->with('danger',"Call has bee deleted.");
    }
}
