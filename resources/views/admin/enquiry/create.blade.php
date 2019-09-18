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
                <form action="{{ route('admin.enquiry.store') }}" method="POST" autocomplete="off" id="enquiry_form" onsubmit="return form_submit()">

                  @csrf
                  <div class="row">
                   
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="name"name="name" required placeholder="Enter the name" value="">
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
                        <input type="text" class="form-control @if($errors->has('phoneno')) is-invalid @endif 
                        @if(count($errors)>0 && !$errors->has('phoneno')) is-valid  @endif" name="phoneno" 
                        required placeholder="Enter the phone"  value="{{ old('phoneno')}}">
                        <small id="numval" style="color:red;display:none;">*Please enter valid Number</small>
                        @if($errors->has('phoneno'))
                        <div class="invalid-feedback">
                            Please Enter  Valid Mobile Number.
                        </div>
                        @endif
                        @if(count($errors)>0 && !$errors->has('phoneno'))                       
                        <div class="valid-feedback">
                            Valid Mobile Number
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>College Name</label>
                        <select id="college" class="ui search dropdown col-md-12" name="college" placeholder="Enter The College Nam">
                        @if(count($colleges)>0)
                            @foreach($colleges as $college)
                              <option value="{{ $college->id }}">{{ $college->college_name }}</option>
                            @endforeach
                          @endif
                        </select>
                        </div>          

                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Semester</label>
                          <select class="form-control" name="semester" placeholder="Enter the semester" id="semester">
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
                        <select class="ui search dropdown col-md-12" name="degree" placeholder="Enter The College Nam">
                            @if(count($degrees)>0)
                                @foreach($degrees as $degree)
                                  <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                                @endforeach
                              @endif
                            </select>
                        </div>          

                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Stream</label>
                        <input type="text" name="stream" id="" class="form-control" placeholder="Enter The Stream">
                        
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>Course Offered</label><br/>
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
                        <select class="form-control" name="duration_id" id="duration" required>
                        
                            @if (count($durations)>0)
                               
                                @foreach ($durations as $duration)
                                  <option value="{{$duration->id}}">{{$duration->name}}</option>
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
                        <textarea class="form-control textarea" id="narration" required="" name="narration"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Refrence By</label>
                        <input type="text" class="form-control" placeholder="" value="" name="refrence">
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
    $('#college,#duration').dropdown({
        clearable: true,
        
    }); 
    $('#semester')
    .dropdown({
        clearable: true,
        placeholder: "Enter The Semester",
        
    }); 
    var srno=1;
    $('#course').on('change',function(){
            var id_ = $(this).val().pop();
            console.log(id_);
           $.ajax({
                'url':'{{ route("api.course.getcourse") }}',
                'method':'GET',
                'data':{
                   
                    "course_id": id_,
                },
                success:function(res){
                  console.log(res);
                  var old_narration = $('#narration').html();
                  var new_narration = srno+". "+res['name']+" Original Fees:"+res['fees']+" Offered Fees:"+res['fees']+
                  "\n";
                  $("#narration").html(old_narration+new_narration);
                  srno+=1;
                  
                },
                error:function(){
                    console.log("course not found");
                }
            });
    });
    function form_submit(){
      var phone_no = $('input[name="phoneno"]').val();
      if (phone_no.length==10){
        return true;
      }
      else{
        $("#numval").show();
        return false;
      }
    }
</script>

@endsection
