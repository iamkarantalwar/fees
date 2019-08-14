<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Enquiry;

class EnquiryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user =  \Auth::user();
    }
    public function index()
    {
       
        $enquiries = Enquiry::all();
        return view('admin.enquiry.index')->with(['enquiries'=>$enquiries]);
    }

   
    public function create()
    {
        $courses = Course::all();
        return view('admin.enquiry.create')->with(['courses'=>$courses]);
    }

   
    public function store(Request $request)
    {
        $enquiry = new Enquiry();
        $enquiry->name = $request->post('name');
        $enquiry->phone_no = $request->post('phoneno');
        $enquiry->email = $request->post('email');
        $enquiry->semester = $request->post('semester');
        $enquiry->college = $request->post('college');
        $enquiry->duration = $request->post('duration');
        $enquiry->narration = $request->post('narration');
        $enquiry->refrence = $request->post('refrence');
        
        $enquiry->save();
        $courses = array_values($request->post('course'));
        $enquiry ->courses() ->attach($courses);

        return redirect()->back()->with('success','Enquiry has been saved.');
    }

  
    public function show($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        $courses = Course::all();        
        $enquiry_courses = $enquiry->courses;

        $courses_detail = $courses->map(function ($item) use($enquiry_courses) {
           
            if($enquiry_courses -> contains('id',$item->id))
            {
                $temp = collect($item)->prepend("1","status");
                 return $temp;
            }
            else
            {
                $temp = collect($item)->prepend("0","status");
                 return $temp;
            }
                
        });   
        
        return view('admin.enquiry.show')->with(['courses'=>$courses_detail,
                                                 'enquiry'=>$enquiry,
                                                ]);
    }

   
    public function edit($id)
    {
       $enquiry = Enquiry::findOrFail($id);
        
        $courses = Course::all();        
        $enquiry_courses = $enquiry->courses;

        $courses_detail = $courses->map(function ($item) use($enquiry_courses) {
           
            if($enquiry_courses -> contains('id',$item->id))
            {
                $temp = collect($item)->prepend("1","status");
                 return $temp;
            }
            else
            {
                $temp = collect($item)->prepend("0","status");
                 return $temp;
            }
                
        });   
        
        return view('admin.enquiry.edit')->with(['courses'=>$courses_detail,
                                                 'enquiry'=>$enquiry,
                                                ]);
    }

   
    public function update(Request $request, $id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->name = $request->post('name');
        $enquiry->phone_no = $request->post('phoneno');
        $enquiry->email = $request->post('email');
        $enquiry->semester = $request->post('semester');
        $enquiry->college = $request->post('college');
        $enquiry->duration = $request->post('duration');
        $enquiry->narration = $request->post('narration');
        $enquiry->refrence = $request->post('refrence');
        $enquiry->save();
        $courses = array_values($request->post('course'));
        $enquiry ->courses()->sync($courses);

        return redirect()->back()->with('success','Enquiry has been updated.');
    }

  
    public function destroy($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();
        return redirect()->route('admin.enquiry.index')
                         ->with('danger','Enquiry has been deleted.');
    }
}
