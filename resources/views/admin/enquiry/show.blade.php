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
                <h2 class="card-title">Show Enquiry</h2>
              </div>
              <div class="card-body">
       
                  <div class="row">
                   
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" disabled class="form-control" name="name" required placeholder="Enter the name" value="{{ $enquiry->name }}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" disabled class="form-control" name="email" required placeholder="Enter the email" value="{{ $enquiry->email }}">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Phone No</label>
                        <input type="text" disabled class="form-control" name="phoneno" required placeholder="Enter the phone"  required value="{{ $enquiry->phone_no }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>College</label>
                        <input type="text" disabled class="form-control" name="college" required placeholder="Enter the college" value="{{ $enquiry->college->college_name }}">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Semester</label>
                        <input type="text" disabled class="form-control" name="semester" required placeholder="Enter the semester" value="{{ $enquiry->semester }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Degree</label>
                          <input type="text" disabled class="form-control" name="college" required placeholder="Enter the college" value="{{ $enquiry->degree->name }}">
                        </div>
                      </div>
                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label>Stream</label>
                          <input type="text" disabled class="form-control" name="semester" required placeholder="Enter the semester" value="{{ $enquiry->stream }}">
                        </div>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>Course</label><br/>
                            <select class="ui search dropdown col-md-12" disabled name="course[]" id="course" multiple="" placeholder="Enter the context" required name="contexts[]">
                                @if(count($courses)>0)

                                    @foreach($courses as $course)

                                        @if($course['status']==1)
                                        <option selected="selected" value="{{ $course['id'] }}">{{ $course['name'] }}</option>
                                        @else
                                        <option  value="{{ $course['id'] }}">{{ $course['name'] }}</option>
                                        @endif
                                    @endforeach

                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Duration</label>
                        <input type="text" class="form-control" disabled placeholder="Enter the duration" name="duration" value="{{ $enquiry->duration->name }}">
                      </div>
                    </div>
                  </div>
                 
                 
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Narration</label>
                        <textarea class="form-control textarea" disabled id="narration" name="narration">{{ $enquiry->narration }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Refrence By</label>
                        <input type="text" disabled class="form-control" placeholder="" value="{{ $enquiry->refrence }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  
                    <div class="row ml-auto mr-auto">
                    <div class="col-md-4">
                     <a href="{{ route('admin.enquiry.edit',['id'=>$enquiry->id]) }}">
                      <button type="button" class="btn btn-outline-primary btn-round">Edit Enquiry</button>
                     </a>
                     </div>
                     <div class="col-md-4">
                      <form class="deleteform" action="{{ route('admin.enquiry.destroy',['id'=>$enquiry->id]) }}" method="post">
                            @method("DELETE")
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-round">Delete Enquiry</button>
                      </form>
                      </div>
                      <div class="col-md-4 ">
                            
                          <a href="{{ route('admin.registration.create',['enquiryid'=>$enquiry->id]) }}">
                            <button type="submit" class="btn btn-outline-success btn-round">Register Enquiry</button>
                          </a>
                      </div>
                    </div>
                  </div>
     
              </div>
            </div>
          </div>
<script src="{{ asset('assets/semantic/dist/semantic.min.js') }}"></script>

<script>

    $('.ui.dropdown')
    .dropdown({
        clearable: true,
        
    }); 


  $('.deleteform').on('submit',function(e){

e.preventDefault();
swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this enquiry!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
})
    .then((willDelete) => {
    if (willDelete) {
        
        $(this).submit();
    } else {
        swal("Your enquiry is safe!");
        return false;
    }
    });
});
</script>

@endsection
