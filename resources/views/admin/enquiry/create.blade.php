@extends('admin.layout')
@section('context')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
    <script>
      demo.showNotification('top','center','{{ Session::get($msg) }}','{{ $msg }}')
    </script>
   
    @endif
  @endforeach
<div class="col-md-12">
            <div class="card card-user">
              <div class="card-header">
                <h2 class="card-title">Add Enquiry</h2>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.enquiry.store') }}" method="POST">

                  @csrf
                  <div class="row">
                   
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required placeholder="Enter the name" value="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" required placeholder="Enter the email">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Phone No</label>
                        <input type="text" class="form-control" name="phoneno" required placeholder="Enter the phone"  required value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>College</label>
                        <input type="text" class="form-control" name="college" required placeholder="Enter the college" value="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Semester</label>
                        <input type="text" class="form-control" name="semester" required placeholder="Enter the semester" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>Course</label><br/>
                            <select class="ui search dropdown col-md-12" name="course[]" id="course" multiple="" placeholder="Enter the context" required name="contexts[]">
                                @if(count($courses)>0)

                                    @foreach($courses as $course)

                                        <option value="{{ $course->id }}">{{ $course->name }}</option>

                                    @endforeach

                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Duration</label>
                        <input type="text" class="form-control" placeholder="Enter the duration" name="duration" value="">
                      </div>
                    </div>
                  </div>
                 
                 
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Narration</label>
                        <textarea class="form-control textarea" id="narration" required="" name="narration"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Refrence By</label>
                        <input type="text" class="form-control" placeholder="" required="" value="" name="refrence">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">Add Enquiry</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
<script src="{{ asset('assets/semantic/dist/semantic.min.js') }}"></script>
<script src="{{ asset('assets/productjs/enquiry_create.js') }}"></script>
<script>
    $('.ui.dropdown')
    .dropdown({
        clearable: true,
        
    }); 
    $('#course').on('change',function(){
           $.ajax({
                'url':'{{ route("api.course.getcourse") }}',
                'method':'GET',
                'data':{
                   
                    "course_id":$(this).val(),
                },
                success:function(res){
                  
                  console.log(res);
                 
                  
                },
                error:function(){
                    console.log("course not found");
                }
            });
    });

    
</script>

@endsection
