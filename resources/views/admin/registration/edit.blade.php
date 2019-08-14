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
         <form action="{{ route('admin.registration.update',['id'=>$registration->id])}}" method="POST">
            @method("PATCH")
            @csrf
            <div class="row">
               <div class="col-md-4 pr-1">
                  <div class="form-group">
                     <label>Name</label>
                     <input type="text" class="form-control" name="name" required placeholder="Enter the name" value="{{ $registration->name }}" >
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Email address</label>
                     <input type="email" class="form-control" name="email" required placeholder="Enter the email" value="{{ $registration->email }}" >
                  </div>
               </div>
               <div class="col-md-4 pl-1">
                  <div class="form-group">
                     <label>Phone No</label>
                     <input type="text" class="form-control" name="phoneno" required placeholder="Enter the phone"  required value="{{ $registration->phoneno }}" >
                  </div>
               </div>
            </div>
            <input type="hidden" name="" value="">
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>College</label>
                     <input type="text" class="form-control" name="college" required placeholder="Enter the college" value="{{ $registration->college }}" >
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Semester</label>
                     <input type="text" class="form-control" name="semester" required placeholder="Enter the semester" value="{{ $registration->semester }}" >
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Course</label><br/>
                     <select class="ui search dropdown col-md-12"    name="course[]" id="course" placeholder="Enter the context" required >                             
                     <?php
                        collect($courses)->map(function($item) use ($registration_courses){
                            if($registration_courses->contains('id',$item->id))
                            {
                              echo "<option selected value='".$item->id."'>".$item->name."</option>";
                            }
                            else
                            {
                              echo "<option value='".$item->id."'>".$item->name."</option>";
                            }
                        });
                        
                        ?>                           
                     </select>
                  </div>
               </div>
               <div class="col-md-6 pl-1" >
                  <div class="form-group" id="contexts-div">
                     <label>Context</label>
                     <select class="col-md-12" multiple="" name="context[]" id="contexts" placeholder="Enter the context" >
                     <?php
                        collect($course_context)->map(function($item) use ($registration_context){
                            if($registration_context->contains('id',$item->id))
                            {
                              echo "<option selected value='".$item->id."'>".$item->context."</option>";
                            }
                            else
                            {
                              echo "<option value='".$item->id."'>".$item->context."</option>";
                            }
                        });
                        
                        ?>         
                     </select>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Extra Course</label>
                     <input type="text" class="form-control" name="extra_context"  placeholder="Enter any extra course" value="{{ $registration->extra_context }}" >
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Training Type</label>
                     <input type="text" class="form-control" name="training_type" required placeholder="Enter the fees" value="{{ $registration->training_type }}" >
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Discount</label>
                     <input type="text" class="form-control" name="discount" required placeholder="Enter the discount" value="{{ $registration->discount }}" >
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Extra Charges</label>
                     <input type="text" class="form-control" name="extra_charges" required placeholder="Enter the extra charges" value="{{ $registration->extra_charges }}" >
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Fees</label>
                     <input type="text" class="form-control" name="fees" required placeholder="Enter the college"  value="{{ $registration->fees }}" >
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Total Fees</label>
                     <input type="text" class="form-control" name="total_fees" required placeholder="Enter the semester" value="{{ $registration->total_fees }}" >
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label>Narration</label>
                     <textarea class="form-control textarea" id="narration" name="narration"  >{{ $registration->narration }}</textarea>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Refrence By</label>
                     <input type="text" class="form-control" placeholder="Enter the refrence" name="refrence" value="{{ $registration->refrence }}" >
                  </div>
               </div>
            </div>
            <div class="row ml-auto mr-auto">
              
                  <div class="col-md-4 ml-auto">
                     <button type="submit" class="btn btn-outline-primary btn-round">Update Registration</button>
                  </div>
              
               </form>
            
                  <div class="col-md-4 mr-auto">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('assets/semantic/dist/semantic.min.js') }}"></script>
<script src="{{ asset('assets/select2/select2.min.js') }}"></script>
<script>
   var fees = 0;
   var total_fees = 0;
   var extra_charges = 0;
   var discount =0;
    
   $('#extra_charges,#discount').on('input', function() {
     this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
   });
   
   $('#extra_charges,#discount').on('blur',function(){
   
     calculateall();
   
   
     // console.log($('#fees').val());
     // if ( isNaN(parseFloat($('#fees').val())))
     // {
     //     $('#fees').val("0.00");
     // }
     // else if (isNaN(parseFloat($("extra_charges").val()))) 
     // {
     //     $('#extra_charges').val("0.00");
     // }
     // console.log($('#discount').val());
   
       
   
   });
   function calculateall()
   {
       dom_fees = parseFloat($("#fees").val());
   
       dom_discount = parseFloat($('#discount').val());
   
       dom_extra_charges = parseFloat($('#extra_charges').val());
   
       extra_charges += parseFloat($("extra_charges").val());
   
       total_fees = dom_fees+dom_extra_charges-dom_discount;
   
       $('#total_fees').val(total_fees);
   }
   
   $('#course').dropdown({
     placeholder:'Select the course',
     
   });
   $('#contexts').select2();
       
   
       
   
    
        
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
                     calculateall();
   
                     
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
                     $('#contexts').val(null).trigger('change');
                     var i;
                     for(i=0;i<res.length;i++)
                     {
                       
                         options += '<option value="'+res[i]['id']+'" selected>'+res[i]['context']+'</option>';
   
                     }
                     $('#contexts').html(options);
                    // $('#contexts-div .ui').html(selected);
                     
                     console.log(options);
   
                    
                     
                   },
                   error:function(){
                       console.log("course not found");
                   }
               });
       });
   
       
   
     
   
       
</script>
@endsection
