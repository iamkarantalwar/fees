<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Context;
use Exception;

class Cotext extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->user =  \Auth::user();
    }
    public function index()
    {
        // $context = Context::findOrFail(3);
        // echo $context->relation();die;
        $contexts = Context::all();       
        return view('admin.contexts.index')->with(['contexts'=>$contexts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contexts.create');
        
    }

   
    public function store(Request $request)
    {
        $context = new Context();
        $context->context=$request->post('context');
        $context->save();
        return redirect()->route('admin.context.index')
                        ->with('success','Context is added.');

    }

  
    public function show($id)
    {
        //
        return "hello world";
    }

  
    public function edit($id)
    {
        $context = Context::find($id);
        return view('admin.contexts.edit')->with(['context'=>$context]);       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $context = Context::findOrFail($id);
        $context->context=$request->post('context');
        $context->save();
        return redirect()->back()->with('success','Context has updated');
    }

    
    public function destroy($id)
    {
        $context = Context::findOrFail($id);
        try
        {  
            $context->delete();
            return redirect()->back()->with('danger','Context has been deleted');
        }
        catch(Exception $e)
        {   
            return redirect()->back()->with('danger','You cannot delete this context.It is associated with other fields.');
        }
        
    }
}
