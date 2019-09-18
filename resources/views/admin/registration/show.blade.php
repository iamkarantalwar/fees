@extends('admin.layout')
@section('context')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
    <script>
      demo.showNotification('top','center','{{ Session::get($msg) }}','{{ $msg }}')
    </script>
   
    @endif
  @endforeach
  
<link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">
<div class="col-md-12">
            <div class="card card-user">
              <div class="card-header">
                <h2 class="card-title">Show Registration</h2>
              </div>
              <div class="card-body">
              

                  @csrf
                  <div class="row">
                   
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required placeholder="Enter the name" value="{{ $registration->name }}" disabled>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" required placeholder="Enter the email" value="{{ $registration->email }}" disabled>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Phone No</label>
                        <input type="text" class="form-control" name="phoneno" required placeholder="Enter the phone"  required value="{{ $registration->phoneno }}" disabled>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="" value="">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>College</label>
                        <input type="text" class="form-control" name="college" required placeholder="Enter the college" value="{{ $registration->college->college_name }}" disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Semester</label>
                        <input type="text" class="form-control" name="semester" required placeholder="Enter the semester" value="{{ $registration->semester }}" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>Course</label><br/>
                            <select class="ui search dropdown col-md-12"  disabled multiple="" name="course[]" id="course" placeholder="Enter the context" required >
                             

                              @foreach($registration->courses as $course)
                                  <option value="{{ $course->id }}" selected>{{ $course->name }}</option>
                              @endforeach                                  
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 pl-1" >
                      <div class="form-group" id="contexts-div">
                        <label>Context</label>
                        <select class="ui search dropdown col-md-12" multiple="" name="context[]" id="contexts" placeholder="Enter the context" disabled >
                            @foreach($registration->contexts as $context)
                                  <option value="{{ $context->id }}" selected>{{ $context->context }}</option>
                            @endforeach 
                               
                        </select>
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Extra Course</label>
                        <input type="text" class="form-control" name="extra_context" required  value="{{ $registration->extra_context }}" disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Training Type</label>
                        <input type="text" class="form-control" name="training_type" required placeholder="Enter the fees" value="{{ $registration->training_type }}" disabled>
                      </div>
                    </div>
                   
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Discount</label>
                        <input type="text" class="form-control" name="discount" required placeholder="Enter the discount" value="{{ $registration->discount }}" disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Extra Charges</label>
                        <input type="text" class="form-control" name="extra_charges" required placeholder="Enter the extra charges" value="{{ $registration->extra_charges }}" disabled>
                      </div>
                    </div>
                  </div>

                 <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Fees</label>
                        <input type="text" class="form-control" name="fees" required placeholder="Enter the college"  value="{{ $registration->payable_fees }}" disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Total Fees</label>
                        <input type="text" class="form-control" name="total_fees" required placeholder="Enter the semester" value="{{ $registration->total_fees }}" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Narration</label>
                        <textarea class="form-control textarea" id="narration" name="narration" disabled >{{ $registration->narration }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Refrence By</label>
                        <input type="text" class="form-control"  name="refrence" value="{{ $registration->refrence }}" disabled>
                      </div>
                    </div>
                   
                  </div>
                  <div class="row">
                  
                    <div class="row ml-auto mr-auto">
                    <div class="col-md-4">
                     <a href="{{ route('admin.registration.edit',['id'=>$registration->id]) }}">
                      <button type="button" class="btn btn-outline-primary btn-round">Edit Registration</button>
                     </a>
                     </div>
                     <div class="col-md-4 ml-4">
                        <form action="{{ route('admin.registration.destroy',['id'=>$registration->id]) }}" method="post">
                              @method("DELETE")
                              @csrf
                              <button type="submit" class="btn btn-outline-danger btn-round">Delete Regestration</button>
                        </form>
                      </div>
                    </div>
                  </div>
               
              </div>
            </div>
          </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('assets/semantic/dist/semantic.min.js') }}"></script>


<script>


$('#course').dropdown({
  placeholder:'Select the course',
  
});
var a = $('#contexts').dropdown({
  'placeholder':'Select the course',
});
   
    
$('#contexts').on('change',function(){
      console.log(a);
      console.log(a.children);
});
    

 
     
    var total_fees = 0;
    $('#course').on('change',function(){
            
            var id = $(this).val();
            $.ajax({
                'url':'{{ route("api.course.getcourse") }}',
                'method':'GET',
                'data':{
                   
                    "course_id":id,
                },
                success:function(res){
                  
                  total_fees +=parseFloat(res["fees"]);
                  $('#contexts').dropdown('clear');

                  
                },
                error:function(){
                    console.log("course not found");
                }
            });


             $.ajax({
                'url':'{{ route("api.course.getcontext") }}',
                'method':'GET',
                'data':{
                   
                    "course_id":$(this).val(),
                },
                success:function(res)
                {
                  console.log(res);
                  var options="";
                  var selected="";
                  $('#contexts').html("");
                  var i;
                  for(i=0;i<res.length;i++)
                  {
                    
                      options += '<option value="'+res[i]['id']+'" >'+res[i]['context']+'</option>';

                  }
                 // $('#contexts-div .ui').html(selected);
                  $('#contexts').html(options);
                  $('#contexts').dropdown();
                  
                  console.log(options);

                 
                  
                },
                error:function(){
                    console.log("course not found");
                }
            });
    });

    

  

    
</script>

@endsection
