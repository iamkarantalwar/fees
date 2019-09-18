<?php

namespace App\Http\Controllers;

use App\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class DegreeController extends Controller
{
    
    public function index()
    {
        $degrees = Degree::all();
        return view('admin.degree.index')->with(['degrees'=>$degrees]);
    }

   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name'=>'required|unique:degrees'
        ]);
        if ($validate->fails()) {
           
           
            return redirect()->back()->with('danger','Degree is already exist.');
        }
        $degree = new Degree();
        $degree->name = $request->post('name');
        $degree->save();

        return redirect()->back()->with('success','Degree has been saved.');
    }

    
    public function show(Degree $degree)
    {
        //
    }

   
    public function edit(Degree $degree)
    {
        return view('admin.degree.edit')->with(['degree'=>$degree]);
    }

  
    public function update(Request $request, Degree $degree)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required|unique:degrees,name,'. $degree->id .'',
        ]);
        if ($validate->fails()) {
           
           
            return redirect()->back()->with('danger','Degree is already exist.')->withErrors($validate);
        }
        $degree->name = $request->post('name');
        $degree->save();

        return redirect()->back()->with('success','Degree has been Updated.');
    }

   
    public function destroy(Degree $degree)
    {
        $degree->delete();
        return redirect()->back()->with('danger','Degree has been Deleted.');

    }
}
