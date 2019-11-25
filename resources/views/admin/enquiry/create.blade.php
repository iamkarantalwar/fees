@extends('admin.layout')
@section('context')
<style>
   label{
   font-weight: bold ! important;
   color: black !important;
   font-size: 17px !important;
   }
   .abc{
   height: 42px !important ;
   }
</style>
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
         <h2 class="card-title text-primary">Add Enquiry</h2>
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
               <div class="col-md-3">
                  <div class="form-group">
                     <label>College Name</label>
                     <select id="college" class="ui search dropdown col-md-12" name="college" placeholder="Enter The College Nam">
                        <option value=" ">Select College Name</option>
                        @if(count($colleges)>0)
                        @foreach($colleges as $college)
                        <option value="{{ $college->id }}">{{ $college->college_name }}</option>
                        @endforeach
                        @endif
                     </select>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label>Semester</label>
                     <select class="form-control" name="semester" placeholder="Enter the semester" id="semester">
                        <option value=" ">Select Semester</option>
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
               <div class="col-md-3">
                  <div class="form-group">
                     <label>Degree</label>
                     <select class="ui search dropdown col-md-12" name="degree" placeholder="Enter The College Nam">
                        <option value=" ">Select Degree</option>
                        @if(count($degrees)>0)
                        @foreach($degrees as $degree)
                        <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                        @endforeach
                        @endif
                     </select>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label>Stream</label>
                     <input type="text" name="stream" id="" class="form-control" placeholder="Enter The Stream">
                  </div>
               </div>
            </div>
            <div class="row">
            </div>
            <div id="single-course" style="display:none;">
               <div class="row">
                  <div class="col-md-3 mycourse">
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>Duration</label>
                        <select class="form-control abc duration" readonly name="duration_id" id="" required>
                           @if (count($durations)>0)
                           <option value="">Select Course</option>
                           @foreach ($durations as $duration)
                           <option value="{{$duration->id}}">{{$duration->name}}</option>
                           @endforeach
                           @else
                           <option disabled selected>Please add the durations</option>
                           @endif
                        </select>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <label>Fees</label>
                        <input type="text" placeholder="fees" readonly name="" id="" class="fees abc form-control">
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <label>Discount</label>
                        <input type="text" placeholder="Discount" name="discount[]" id="" class="discount abc form-control">
                     </div>
                  </div>
                  <div class="col-md-1">
                     <div class="form-group">
                        <label>Actions</label>
                        <div class="btn-group">
                           <a class="btn-success btn btn-sm addme" onclick="addme()">
                           Add
                           </a>
                           <a class="btn-dangeer btn btn-sm remove" onclick="removeme(this)">
                           Remove
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="courses">
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>Course Offered</label><br/>
                        <select  class="ui search dropdown col-md-12 course form-control abc" name="course[]"  placeholder="Enter the context" required name="contexts[]">
                           @if(count($courses)>0)
                           <option value="">Select Course</option>
                           @foreach($courses as $course)
                           <option value="{{ $course->id }}">{{ $course->name }}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>Duration</label>
                        <select class="form-control abc duration" name="duration_id" id="" readonly required>
                           @if (count($durations)>0)
                           <option value="">Select Course</option>
                           @foreach ($durations as $duration)
                           <option value="{{$duration->id}}">{{$duration->name}}</option>
                           @endforeach
                           @else
                           <option disabled selected>Please add the durations</option>
                           @endif
                        </select>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <label>Fees</label>
                        <input type="text" placeholder="fees" name="" id="" readonly class="fees abc form-control">
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <label>Discount</label>
                        <input type="text" placeholder="Discount" name="discount[]" id="" class="discount abc form-control">
                     </div>
                  </div>
                  <div class="col-md-1">
                     <div class="form-group">
                        <label>Actions</label>
                        <div class="btn-group">
                           <a class="btn-success btn btn-sm addme">
                           Add
                           </a>
                           <a class="btn-danger btn btn-sm remove" onclick="removeme(this)">
                           Remove
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Narration</label>
                     <textarea style="min-height: 121px;" class="form-control textarea" id="narration" required="" name="narration"></textarea>
                  </div>
               </div>
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Refrence By</label>
                     <input type="text" class="form-control" placeholder="" value="" name="refrence">
                  </div>
                  <div class="form-group">
                     <label>Faculty Name</label>
                     <input type="text" class="form-control" placeholder="" value="" name="refrence">
                  </div>
               </div>
            </div>
            <div class="row">
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
<link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">
<script src="{{ asset('assets/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/semantic/dist/semantic.min.js') }}"></script>
<script src="{{ asset('assets/productjs/enquiry_create.js') }}"></script>
<script>
   function removeme(element){
      a = element.closest(".row").remove();
   
      
   }
   courses =null;
   i =1;
   $(document).ready(function(){
      $.get(`{{ route('api.getcourses') }}`).done((res)=>courses=res);
   
   
   $(".addme").click(function(e){
       e.preventDefault();
       
       console.log(i);
       let courses_select = `
         <div class="form-group"><label>Course Offered</label>
       <select class="coursea${i} form-control abc" name="course[]">
            <option value="">Select Course</option>`;
       courses.forEach(element => {
          courses_select+=`<option value='${element.id}'>${element.name}</option>`;
       });
       courses_select+="</select></div>";
     
     
       var courses_class = $("#single-course").find('.mycourse').html(courses_select);
       var singlecoursediv = $("#single-course").html(); 
       $('#courses').append(singlecoursediv);
       
       i=i+1;
   });
   
   
   });
   $(document.body).on('change', '[name="course[]"]' ,function(){
   const id = $(this).val();
   console.log(id);
   var route =` {{ route('api.course.getcourse',['course_id'=>':id']) }}`;
   route = route.replace("%3Aid",id);
   console.log(route);
   $.get(route)
   .done((res)=>{
      console.log(res);
    $(this).closest(".row").find(".fees").val(res.fees);
   a = $(this).closest(".row").find(".duration").val(res.duration_id);
   console.log(a);
   
   });
   
   });
   
   function addme(){
   let courses_select = `
         <div class="form-group"><label>Course Offered</label>
       <select class="coursea${i} form-control abc" name="course[]">`;
       courses.forEach(element => {
          courses_select+=`<option value='${element.id}'>${element.name}</option>`;
       });
       courses_select+="</select></div>";
       console.log(courses_select);
     
       var courses_class = $("#single-course").find('.mycourse').html(courses_select);
       var singlecoursediv = $("#single-course").html(); 
       $('#courses').append(singlecoursediv);
       $(`.coursea${i}`).select2();
       i=i+1;
   
   }
   //   $('.ui.dropdown')
   //   .dropdown({
   //       clearable: true,
         
   //   }); 
   //    $('.course').select2({
   //   placeholder: 'Select an option'
   // });
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