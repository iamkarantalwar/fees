<?php

namespace App\Http\Controllers;

use App\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
      
    }
    
    public function index()
    {
        $colleges = College::all();
        return view('admin.college.index')->with(['colleges'=>$colleges]);
    }

    
    public function create()
    {
        return view('admin.college.create');
    }

  
    public function store(Request $request)
    {
        $this->validate($request,[
            'college_name'=>'required|unique:colleges'
        ]);
        $college = new College();
        $college->college_name = $request->post('college_name');
        $college->save();
        
        return redirect()->back()->with('success','College has been saved.');
    }

 
    public function show(College $college)
    {
       
    }

   
    public function edit(College $college)
    {
        return view('admin.college.edit')->with(['college'=>$college]);
    }

   
    public function update(Request $request, College $college)
    {
        $this->validate($request,[
            'college_name' => 'required|unique:colleges,college_name,'. $college->id .'',
        ]);
        
        return redirect()->back()->with('success','College has been updated.');
        
    }

  
    public function destroy(College $college)
    {
        $college->delete();
        return redirect()->back()->with('danger','College has been deleted.');
    }
}
