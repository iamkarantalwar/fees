<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use App\Course;
use App\Enquiry;
use App\Fee;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user =  \Auth::user();
    }
    public function index()
    {
            
            $registrations = Registration::all();
            return view('admin.registration.index')->with(['registrations'=>$registrations]);
           
    }

   
    public function create(Request $request)
    {    
        $enquiryid = $request->get('enquiryid');
       
      
        if ($enquiryid!=null)
         {

           $enquiry = Enquiry::findOrFail($enquiryid);       
            $courses = Course::all();
            return view('admin.registration.create')->with(['courses'=>$courses,
                                                            'enquiry'=>$enquiry]);
         }
         else
         {
            $courses = Course::all();
            return view('admin.registration.create')->with(['courses'=>$courses]);
         }
    }

    
    public function store(Request $request)
    {
       
        $registration = new Registration();
        $registration->name = $request->post('name');
        $registration->phoneno = $request->post('phoneno');
        $registration->email = $request->post('email');
        $registration->semester = $request->post('semester');
        $registration->college = $request->post('college');
      
        $registration->narration = $request->post('narration');
        $registration->training_type = $request->post('training_type');
        $registration->extra_context = $request->post('extra_context');
        $registration->payable_fees = $request->post('fees');
        $registration->discount = $request->post('discount');
        $registration->extra_charges= $request->post('extra_charges');
        $registration->narration = $request->post('narration');
        $registration->refrence = $request->post('refrence');
        $registration->total_fees = $request->post('total_fees');
    
        $registration->enquiry_id = $request->post('enquiry_id');
        $registration->reciept_no = $request->post('reciept_no');
        $registration->registration_amount = $request->post('registration_amount');
        $registration->due_fees = $request->post('due_fees');
        $registration->save();

        $fee  = new Fee();
        $fee->registration_id = $registration->id;
        $fee->recipt_no = $request->post('reciept_no');
        $fee->payable_amount = $request->post('registration_amount');
        $fee->pending_amount =  $request->post('due_fees');
        $fee->save();
        
        $courses = array_values($request->post('course'));
        $registration ->courses() ->attach($courses);

       
        $contexts =  array_values($request->post('context'));
        $registration ->contexts() ->attach($contexts,['course_id'=>$courses[0]]);
       
        return redirect()->back()->with('success','Registration has been updated.');
    }

   
    public function show(Registration $registration)
    {
        return view('admin.registration.show')->with(['registration'=>$registration]);
    }

   
    public function edit(Registration $registration)
    {
        $courses = Course::all();
        $registration_courses =  $registration->courses;
        $course_context = $registration->courses->first()->contexts;
        $registration_context = $registration->contexts;
       
        return view('admin.registration.edit')->with(['registration'=>$registration,
                                                     'courses'=>$courses,
                                                      'registration_courses'=>$registration_courses,
                                                      'course_context'=>$course_context,
                                                      'registration_context'=> $registration_context
                                                  ]);
    }

   
    public function update(Request $request, Registration $registration)
    {
        
        $registration->name = $request->post('name');
        $registration->phoneno = $request->post('phoneno');
        $registration->email = $request->post('email');
        $registration->semester = $request->post('semester');
        $registration->college = $request->post('college');
      
        $registration->narration = $request->post('narration');
        $registration->training_type = $request->post('training_type');
        $registration->extra_context = $request->post('extra_context');
        $registration->fees = $request->post('fees');
        $registration->discount = $request->post('discount');
        $registration->extra_charges= $request->post('extra_charges');
        $registration->narration = $request->post('narration');
        $registration->refrence = $request->post('refrence');
        $registration->total_fees = $request->post('total_fees');
    

        
        $registration->save();
        $courses = array_values($request->post('course'));
        $registration ->courses() ->sync($courses);

        
        
        $contexts = [];
        foreach ($request->post('context') as $key => $value) 
        {
            $contexts[$value]=['course_id'=>$courses[0]];
        }
        print_r($contexts);
        $registration->contexts()->sync($contexts);
       
        return redirect()->back()->with('success','Registration has been saved.');
    }

    
    public function destroy(Registration $registration)
    {
        
        $registration->contexts()->detach();
        $registration->courses()->detach();
        $registration->delete();
        return redirect()->route('admin.registration.index')
                         ->with('danger','Registration has been delete.');

    }
}
