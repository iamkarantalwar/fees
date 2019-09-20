<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Enquiry;
use App\College;
use App\Duration;
use App\Degree;
use Exception;
class EnquiryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
      
    }
    public function index()
    {
        
        $enquiries = Enquiry::doesnthave('registration')->get();
        return view('admin.enquiry.index')->with(['enquiries'=>$enquiries]);
    }

   
    public function create()
    {
        $enquiries = Enquiry::all();
        $enq_id;
        if(count($enquiries)==0){
            $enq_id=1;
        }
        else{
            $enq_id = $enquiries->last()->id + 1; 
        }
       
        $degrees = Degree::all();
        $durations = Duration::all();
        $colleges = College::all();
        $courses = Course::all();
        return view('admin.enquiry.create')->with(['courses'=>$courses,'colleges'=>$colleges,
                                                   'durations'=>$durations,'degrees'=>$degrees]);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'phoneno' => ['required',
                        'regex:/^[0-9]+$/']
        ],[
            'phoneno'=>'Please Enter The Valid Mobile Number'
        ]);            
        
        $enquiry = new Enquiry();
        $enquiry->name = $request->post('name');
        $enquiry->phone_no = $request->post('phoneno');
        $enquiry->email = $request->post('email');
        $enquiry->semester = $request->post('semester');
        $enquiry->college_id = $request->post('college');
        $enquiry->duration_id = $request->post('duration_id');
        $enquiry->narration = $request->post('narration');
        $enquiry->refrence = $request->post('refrence');
        $enquiry->degree_id = $request->post('degree');
        $enquiry->stream = $request->post('stream');
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
        $colleges = College::all();        
        $degrees = Degree::all();
        $durations = Duration::all();
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
                                                 'colleges'=>$colleges,
                                                 'durations'=>$durations,
                                                 'degrees'=>$degrees
                                                ]);
    }

   
    public function update(Request $request, $id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->name = $request->post('name');
        $enquiry->phone_no = $request->post('phoneno');
        $enquiry->email = $request->post('email');
        $enquiry->semester = $request->post('semester');
        $enquiry->college_id = $request->post('college');
        $enquiry->duration_id = $request->post('duration_id');
        $enquiry->narration = $request->post('narration');
        $enquiry->refrence = $request->post('refrence');
        $enquiry->degree_id = $request->post('degree');
        $enquiry->stream = $request->post('stream');
        $enquiry->save();
        $courses = array_values($request->post('course'));
        $enquiry ->courses()->sync($courses);

        return redirect()->back()->with('success','Enquiry has been updated.');
    }

  
    public function destroy($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $callings = count($enquiry->callings);

        if($callings==0)
        {
            $enquiry->courses()->detach();
            $enquiry->delete();
                return redirect()->route('admin.enquiry.index')
                                 ->with('danger','Enquiry has been deleted.');
        }
        else {
            return redirect()->back()->with('danger','You cannot delete this enquiry.It is associated with other fields.');
        }
            
       
    }
}
