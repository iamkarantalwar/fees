<?php

namespace App\Http\Controllers;

use App\Course;
use App\Context;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user =  \Auth::user();
    }
    public function index()
    {
       $courses = Course::all();
       return view('admin.course.index')->with(['courses'=>$courses]);
    }
  
    public function create()
    {
        $contexts = Context :: all();
        return view('admin.course.create')->with(['contexts'=>$contexts]);
    }

    public function store(Request $request)
    {
        $a = new Course();
        $a ->name = $request->post('course');
        $a ->duration = $request->post('duration');        
        $a ->fees = $request->post('fees');            
        $a ->save();
        $context = array_values($request->post('contexts'));
        $a ->contexts() ->attach($context);

        return redirect()->route('admin.course.index')
                         ->with('success','Course has been added.');
    }

   
    public function show(Course $course)
    {
        //
    }

    public function edit(Course $course)
    {       
        $all_contexts = Context :: all();
        $avail_contexts = $course->contexts;    
       
        $context_list = $all_contexts->map(function ($item) use($avail_contexts) {
          
            if($avail_contexts -> contains($item))
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

        return view('admin.course.edit')->with(['contexts'  => $context_list,                                       
                                                'course'    => $course,
                                                ]);

    }

  
    public function update(Request $request, Course $course)
    {
        $course ->name = $request->post('course');
        $course ->duration = $request->post('duration');        
        $course ->fees = $request->post('fees');  
        $context = array_values($request->post('contexts'));
        $course ->contexts() ->sync($context);          
        $course ->save();
        return redirect()->route('admin.course.edit',$course->id)
                         ->with('success','Course has been update.');
        
    }

   
    public function destroy(Course $course)
    {
        $course->contexts()->detach();
        $course->delete();
        return redirect()->route('admin.course.index',$course->id)
                         ->with('danger','Course has been delete.');
    }

    
}
