<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use App\Course;
use App\Enquiry;
use App\Fee;
use App\College;
use App\Degree;
use \Auth;
use Exception;
class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
      
    }
    public function index()
    {
            
            $registrations = Registration::all();
            return view('admin.registration.index')->with(['registrations'=>$registrations]);
           
    }

   
    public function create(Request $request)
    {    
        $degrees = Degree::all();
        $enquiryid = $request->get('enquiryid');
        $courses = Course::all();
        $colleges = College::all();
        if ($enquiryid!=null)
         {
           $register = Registration::where('id',$enquiryid)->get();          
           if($register->isEmpty())
           {
                $enquiry = Enquiry::findOrFail($enquiryid);     
            
                return view('admin.registration.create')->with(['courses'=>$courses,
                                                                'enquiry'=>$enquiry,
                                                                'colleges'=>$colleges,
                                                                'degrees'=>$degrees]);
           }
           else
           {
                return redirect()->back()->with('danger','This Enquiry is already registered with us.');
           }         
         }
         else
         {           
            return view('admin.registration.create')->with(['courses'=>$courses,
                                                            'colleges'=>$colleges,
                                                            'degrees'=>$degrees]);
         }
    }

    
    public function store(Request $request)
    {
       
        $registration = new Registration();
        $registration->name = $request->post('name');
        $registration->phoneno = $request->post('phoneno');
        $registration->email = $request->post('email');
        $registration->semester = $request->post('semester');
        $registration->college_id = $request->post('college');
        $registration->degree_id = $request->post('degree');
        $registration->other = $request->post('other');
        $registration->training_type = $request->post('training_type');
        $registration->extra_context = $request->post('extra_context');
        $registration->payable_fees = $request->post('total_fees');
        $registration->discount = $request->post('discount');
    
   
        $registration->refrence = $request->post('refrence');
      
        $registration->stream = $request->post('stream');
        $registration->enquiry_id = $request->post('enquiry_id');
      

        $registration->gender=$request->post('gender');
        $registration->address = $request->post("address");
        $registration->fname = $request->post("fname");
        $registration->relation_type=$request->post('relation_type');
        $registration->save();

        $fee  = new Fee();
        $fee->registration_id = $registration->id;
        $fee->recipt_no = $request->post('reciept_no');
        $fee->payable_amount = $request->post('registration_amount');
        $fee->pending_amount = $request->post('total_fees')- $request->post('registration_amount')-$request->post('discount');
        $fee->user_id = Auth::user()->id;
        $fee->save();
        
       // $courses = array_values($request->post('course'));
        $registration ->courses() ->attach(array($request->post('course')));

       
        //$contexts =  array_values($request->post('context'));
        //$registration ->contexts() ->attach($contexts,['course_id'=>$courses[0]]);
       
        return redirect()->back()->with('success','Registration has been updated.');
    }

   
    public function show(Registration $registration)
    {
        return view('admin.registration.show')->with(['registration'=>$registration]);
    }

   
    public function edit(Registration $registration)
    {
        $degrees = Degree::all();
        $colleges = College::all();
        $courses = Course::all();
        $registration_courses =  $registration->courses;
        $course_context = $registration->courses->first()->contexts;
        $registration_context = $registration->contexts;
       
        return view('admin.registration.edit')->with(['registration'=>$registration,
                                                     'courses'=>$courses,
                                                      'registration_courses'=>$registration_courses,
                                                      'course_context'=>$course_context,
                                                      'registration_context'=> $registration_context,
                                                      'colleges'=>$colleges,
                                                      'degrees'=>$degrees
                                                  ]);
    }

   
    public function update(Request $request, Registration $registration)
    {
        
        $registration->name = $request->post('name');
        $registration->phoneno = $request->post('phoneno');
        $registration->email = $request->post('email');
        $registration->semester = $request->post('semester');
        $registration->college_id = $request->post('college');
      
        $registration->narration = $request->post('narration');
        $registration->training_type = $request->post('training_type');
        $registration->extra_context = $request->post('extra_context');
        $registration->payable_fees = $request->post('fees');
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
        return redirect()->back()->with('danger','You cannot delete this registration.It is associated with other fields.');
       
      

    }

    public function form(Request $request){
        $degrees = Degree::all();
        $enquiryid = $request->get('enquiryid');
        $courses = Course::all();
        $colleges = College::all();
        if ($enquiryid!=null)
         {
           $register = Registration::where('id',$enquiryid)->get();          
           if($register->isEmpty())
           {
                $enquiry = Enquiry::findOrFail($enquiryid);     
            
                return view('admin.registration.create')->with(['courses'=>$courses,
                                                                'enquiry'=>$enquiry,
                                                                'colleges'=>$colleges,
                                                                'degrees'=>$degrees]);
           }
           else
           {
                return redirect()->back()->with('danger','This Enquiry is already registered with us.');
           }         
         }
         else
         {           
            return view("admin.registration.form")->with(['courses'=>$courses,
                                                            'colleges'=>$colleges,
                                                            'degrees'=>$degrees]);
         }
 
       
    }
}
