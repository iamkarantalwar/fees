@extends('admin.layout')
@section('context')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(Session::has($msg))
<script>
   demo.showNotification('top','center','{{ Session::get($msg) }}','{{ $msg }}')
</script>
@endif
@endforeach
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
<div class="col-md-12">
   <div class="card card-user">
      <div class="card-header">
         <h2 class="card-title">Edit Enquiry</h2>
      </div>
      <div class="card-body">
         <form action="{{ route('admin.enquiry.update',['enquiry'=>$enquiry->id])}}" method="POST">
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
               <div class="col-md-3">
                  <div class="form-group">
                     <label>College Name</label>
                     <select id="college" class="ui search dropdown col-md-12" name="college">
                        <option value=" ">Select College Name</option>
                        @if(count($colleges)>0)
                        @foreach($colleges as $college)
                        @if ($college->id == $enquiry->college_id)
                        <option selected value="{{ $college->id }}">{{ $college->college_name }}</option>
                        @else
                        <option value="{{ $college->id }}">{{ $college->college_name }}</option>
                        @endif
                        @endforeach
                        @endif
                     </select>
                  </div>
               </div>
               <div class="col-md-3">
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
               <div class="col-md-3">
                  <div class="form-group">
                     <label>Degree</label>
                     <select class="ui search dropdown col-md-12" name="degree" placeholder="Enter The Degree Name" required>
                        <option value=" ">Select Degree </option>
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
               <div class="col-md-3">
                  <div class="form-group">
                     <label>Stream</label>
                     <input type="text" name="stream" id="" class="form-control" placeholder="Enter The Stream"  value="{{ $enquiry->stream }}">
                  </div>
               </div>
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
               @foreach ($enquiry->courses as $item)
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>Course Offered</label><br/>
                        <select  class="ui search dropdown col-md-12 course form-control abc" name="course[]"  placeholder="Enter the context" required name="contexts[]">
                           @if(count($courses)>0)
                           @foreach($courses as $course)
                           @if($item->id==$course->id)
                           <option selected value="{{ $course->id }}">{{ $course->name }}</option>
                           @else
                           <option value="{{ $course->id }}">{{ $course->name }}</option>
                           @endif
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
                           @if($item->duration_id==$duration->id)
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
                  <div class="col-md-2">
                     <div class="form-group">
                        <label>Fees</label>
                        <input type="text" placeholder="fees" name="" id="" readonly value="{{ $item->fees }}" class="fees abc form-control">
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <label>Discount</label>
                        <input type="text" placeholder="Discount" name="discount[]" id="" class="discount abc form-control" value="{{ $item->pivot->discount}}">
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
               @endforeach
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Narration</label>
                     <textarea style="min-height: 121px;" class="form-control textarea"  id="narration" required="" name="narration">{{ $enquiry->narration }}</textarea>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="col-md-12 pr-1">
                     <div class="form-group">
                        <label>Refrence By</label>
                        <input type="text"   value="{{ $enquiry->refrence}}" class="form-control textarea" placeholder=""  value="" name="refrence">
                     </div>
                     <div class="form-group">
                        <label>Faculty Name</label>
                        <input type="text" class="form-control" placeholder="" value="" name="faculty">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
            </div>
            <div class="row">
               <div class="update ml-auto mr-auto">
                  <button type="submit" class="btn btn-outline-primary btn-round">Update Enquiry</button>
         
                </form>
         <form class="deleteform" action="{{ route('admin.enquiry.destroy',['enquiry'=>$enquiry->id]) }}" method="POST">
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
</script>
@endsection