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
                <h2 class="card-title">Edit Enquiry</h2>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.enquiry.update',['id'=>$enquiry->id])}}" method="POST">
                  @method("PUT")
                  @csrf       
                  <div class="row">
                
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text"  class="form-control" name="name" required placeholder="Enter the name" value="{{ $enquiry->name }}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email"  class="form-control" name="email" required placeholder="Enter the email" value="{{ $enquiry->email }}">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Phone No</label>
                        <input type="text"  class="form-control" name="phoneno" required placeholder="Enter the phone"  required value="{{ $enquiry->phone_no }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                   
                      <div class="form-group">
                        <label>College Name</label>
                        <select id="college" class="ui search dropdown col-md-12" name="college">
                         
                          @if(count($colleges)>0)
                              @foreach($colleges as $college)
                               @if ($college->id == $enquiry->college->id)
                                  <option selected value="{{ $college->id }}">{{ $college->college_name }}</option>
                               @else
                                  <option value="{{ $college->id }}">{{ $college->college_name }}</option>
                               @endif
                               
                              @endforeach
                            @endif
                        </select>
                        </div>         
                    </div>
                    <div class="col-md-6 pl-1">
                    <div class="form-group">
                        <label>Semester</label>
                          <select class="form-control" name="semester" placeholder="Enter the semester" id="semester">
                            <option value="{{ $enquiry->semester }}" selected readonly>{{ $enquiry->semester }}</option>
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                            <option value="3rd">3rd</option>
                            <?php 
                              for($i=4;$i<=8;$i++)
                              {
                                echo "<option value='".$i.'th'."'>".$i."th"."</option>";
                              }
                            ?>
                          </select>
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Degree</label>
                          <select class="ui search dropdown col-md-12" name="degree" placeholder="Enter The Degree Name" required>
                              @if(count($degrees)>0)
                                  @foreach($degrees as $degree)
                                    @if ($degree->id == $enquiry->degree_id)
                                    <option selected value="{{ $degree->id }}">{{ $degree->name }}</option>
                                    @else
                                      <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                                    @endif
                                    
                                  @endforeach
                                @endif
                              </select>
                          </div>          
  
                      </div>
                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label>Stream</label>
                        <input type="text" name="stream" id="" class="form-control" placeholder="Enter The Stream" required value="{{ $enquiry->stream }}">
                          
                        </div>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>Course</label><br/>
                            <select class="ui search dropdown col-md-12"  name="course[]" id="course" multiple="" placeholder="Enter the context" required name="contexts[]">
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
                          <select class="form-control ui search dropdown" name="duration_id" id="duration" required>
                          
                              @if (count($durations)>0)
                                 
                                  @foreach ($durations as $duration)
                                    @if ($duration->id == $enquiry->duration_id)
                                      <option selected value="{{$duration->id}}">{{$duration->name}}</option>
                                    @else
                                      <option value="{{$duration->id}}">{{$duration->name}}</option>
                                    @endif
                                    
                                  @endforeach
                              @else
                                  <option disabled selected>Please add the durations</option>
                              @endif
                          </select>
                        </div>
                      </div>
                  </div>
                 
                 
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Narration</label>
                        <textarea class="form-control textarea"  id="narration" required="" name="narration">{{ $enquiry->narration }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Refrence By</label>
                        <input type="text"  class="form-control" placeholder=""  value="" name="refrence">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">                    
                        <button type="submit" class="btn btn-outline-primary btn-round">Update Enquiry</button>
                        </form>
                        <form class="deleteform" action="{{ route('admin.enquiry.destroy',['id'=>$enquiry->id]) }}" method="POST">
                            @method("DELETE")
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-round">Delete Enquiry</button>
                        </form>
                    </div>
                  </div>

             
              </div>
            </div>
          </div>
<script src="{{ asset('assets/semantic/dist/semantic.min.js') }}"></script>

<script>

    $('#semester').dropdown();

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
