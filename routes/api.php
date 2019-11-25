<?php

use Illuminate\Http\Request;

use App\Course;
use App\Enquiry;
use App\Registration;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/getcourses",function(){
        return Course::all();
})->name('api.getcourses');

Route::get('/admin/getcourse/',function(Request $request){
    $course_id = $request->get('course_id');
    $course = Course::findOrFail($course_id);   
    return $course; 
    })->name('api.course.getcourse');

Route::get('/admin/getcontext/',function(Request $request){
    $course_id = $request->get('course_id');
    $course = Course::findOrFail($course_id);  
    $context = $course->contexts; 
    return $context; 
    })->name('api.course.getcontext');


Route::get('/admin/enquiries/',function(Request $request){
  
   $enquiries = Enquiry::doesnthave('registration')->with('callings')->with('courses')->with('college')->get();

    return ($enquiries);
     })->name('api.fetchallenquiries');

Route::get('/admin/enquiries/filter',function(Request $request){
    $enquiries = Enquiry::orWhere('id',$request->get('enquiry_id'))->orWhere('name',$request->get('name'))->
                         orWhere('semester',$request->get('semester'))->orWhere('college_id',$request->get('college'))->
                          with('callings')->with('courses')->with('college')->get();
    return ($enquiries);
    })->name('api.filterenquiries');



    // ---------------------------------------------------------Registration APIS ------------------- //

Route::get('/admin/registerations/',function(Request $request){
   
    $registrations = Registration::with('fees')->with('courses')->with('college')->get();

   return ($registrations);
     
    
})->name('api.fetchallregistrations');

Route::get('/admin/registerations/filter',function(Request $request){
    
    
    $registrations = Registration::orWhere('id',$request->get('registration_id'))->orWhere('name',$request->get('name'))->
                         orWhere('semester',$request->get('semester'))->orWhere('college',$request->get('college'))->
                          with('callings')->with('courses')->with('college')->get();

   return ($registrations);
     
    
})->name('api.filterregistrations');