<?php

namespace App\Http\Controllers;

use App\Duration;
use Illuminate\Http\Request;
use Exception;
class DurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
      
    }
    public function index()
    {
        $durations = Duration::all();
        return view('admin.duration.index')->with(['durations'=>$durations]);
    }

    
    public function create()
    {
        return view('admin.duration.create');
    }

    
    public function store(Request $request)
    {
        $duration = new Duration();
        $duration->name = $request->post('duration');
        $duration->code = $request->post('code');
        $duration->save();

        return redirect()->back()->with('success','Duration has been saved.');

    }

   
    public function show(Duration $duration)
    {
        //
    }

   
    public function edit(Duration $duration)
    {
        return view('admin.duration.edit')->with(['duration'=>$duration]);
    }

  
    public function update(Request $request, Duration $duration)
    {
        $duration->name = $request->post('duration');
        $duration->code = $request->post('code');
        $duration->save();

        return redirect()->back()->with('success','Duration has been updated.');
    }

   
    public function destroy(Duration $duration)
    {
       
        
        try
        {  
            $duration->delete();
            return redirect()->back()->with('danger','Duration has been deleted');
        }
        catch(Exception $e)
        {   
            return redirect()->back()->with('danger','You cannot delete this Duration.It is associated with other fields.');
        }

       
    }
}
