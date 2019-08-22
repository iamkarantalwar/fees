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
   <form action="{{ route('admin.registration.store') }}" method="POST" nonvalidate>
      <div class="card card-user">
         <div class="card-header">
            <h2 class="card-title">Add Registration</h2>
         </div>
         <div class="card-body">
            @csrf
            <div class="row">
               <div class="col-md-4 pr-1">
                  <div class="form-group">
                     <label>Name</label>
                     <input type="text" class="form-control" name="name" required placeholder="Enter the name" 
                        value="{{ !empty($enquiry) ? $enquiry->name :'' }}">
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Email address</label>
                     <input type="email" class="form-control" name="email" required placeholder="Enter the email"
                        value="{{ !empty($enquiry) ? $enquiry->email :'' }}">
                  </div>
               </div>
               <div class="col-md-4 pl-1">
                  <div class="form-group">
                     <label>Phone No</label>
                     <input type="text" class="form-control" name="phoneno" required placeholder="Enter the phone"  required value="{{ !empty($enquiry) ? $enquiry->phone_no :'' }}">
                  </div>
               </div>
            </div>
            <input type="hidden" name="enquiry_id" value="{{ !empty($enquiry) ? $enquiry->id :'' }}">
            <div class="row">
               <div class="col-md-6 pr-1">
               <div class="form-group">
                        <label>College Name</label>
                        <select id="college" class="ui search dropdown col-md-12" name="college">
                         
                          @if(count($colleges)>0)
                              @foreach($colleges as $college)
                                <option value="{{ $college->college_name }}">{{ $college->college_name }}</option>
                              @endforeach
                            @endif
                        </select>
                        </div>         
               </div>
               <div class="col-md-6 pl-1">
                  <!-- <div class="form-group">
                     <label>Semester</label>
                     <input type="text" class="form-control" name="semester" required placeholder="Enter the semester" 
                        value="{{ !empty($enquiry) ? $enquiry->semester :'' }}">
                  </div> -->
                  <div class="form-group">
                        <label>Semester</label>
                          <select class="form-control" name="semester" placeholder="Enter the semester" id="semester">
                        @if(!empty($enquiry))
                            <option value="{{ $enquiry->semester }}" selected readonly>{{ $enquiry->semester }}</option>
                        @endif
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
                     <label>Course</label><br/>
                     <select class="ui search dropdown col-md-12" name="course[]" id="course" placeholder="Enter the context" required >
                        <option value="" disabled="" selected="">Select Course</option>
                        @if(count($courses)>0)
                        @if(!empty($enquiry))
                        @foreach($courses as $course)
                        @if($course->id == $enquiry->courses[0]->id)
                        <option selected value="{{ $course->id }}">{{ $course->name }} - {{ $course->duration }}</option>
                        @else
                        <option value="{{ $course->id }}">{{ $course->name }} - {{ $course->duration }}</option>
                        @endif
                        @endforeach
                        @else 
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }} - {{ $course->duration }}</option>
                        @endforeach
                        @endif
                        @endif
                     </select>
                  </div>
               </div>
               <div class="col-md-6 pl-1" >
                  <div class="form-group" id="contexts-div">
                     <label>Context</label>
                     <select class="ui search dropdown col-md-12" multiple="" required name="context[]" id="contexts" placeholder="Enter the context" >
                        @if(!empty($enquiry))
                        @foreach($enquiry->courses[0]->contexts as $context)
                        <option value='{{ $context->id }}' selected="">{{ $context->context }}</option>
                        @endforeach
                        @endif
                     </select>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Extra Course</label>
                     <input type="text" class="form-control" name="extra_context"  placeholder="Enter any extra course" value="">
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Training Type</label>
                     <input type="text" class="form-control" name="training_type" required placeholder="Enter the training type" value="">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Extra Charges</label>
                     <input type="text" class="form-control" id="extra_charges" name="extra_charges" required placeholder="Enter the extra charges" value="0.00">
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Discount</label>
                     <input type="text" class="form-control" id="discount" name="discount" required placeholder="Enter the discount" value="0.00">
                  </div>
               </div>
            </div>
            <input type="hidden" id="course_fees" value="{{ !empty($enquiry) ? $enquiry->courses[0]->fees: '0.00' }}">
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Fees</label>
                     <input type="text" class="form-control" id="fees" name="fees" required placeholder="Enter the college" value="{{ !empty($enquiry) ? $enquiry->courses[0]->fees : '0.00'}}">
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Total Fees</label>
                     <input type="text" class="form-control" readonly id="total_fees" name="total_fees" required placeholder="Enter the semester" value="{{ !empty($enquiry) ? $enquiry->courses[0]->fees : '0.00'}}">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Registration Amount</label>
                     <input type="text" class="form-control" id="registration_amount" name="registration_amount" required placeholder="Enter the Amount" value="0.00">
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Reciept Number</label>
                     <input type="text" class="form-control" id="recipt_num" name="reciept_no" required placeholder="Enter The Recipt Number" >
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Pending Amount</label>
                     <input type="text" class="form-control" readonly id="due_fees" name="due_fees" required value="0.00" >
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Refrence By</label>
                     <input type="text" class="form-control" placeholder="Enter the refrence" value="{{ !empty($enquiry) ? $enquiry->refrence : ''}}" name="refrence">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label>Narration</label>
                     <textarea class="form-control textarea" id="narration" name="narration">{{ !empty($enquiry) ? $enquiry->narration : ''}}</textarea>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="update ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary btn-round">Add Registration</button>
               </div>
            </div>
         </div>
      </div>
    </form>
</div>

<script src="{{ asset('assets/semantic/dist/semantic.min.js') }}"></script>
<script src="{{ asset('assets/select2/select2.min.js') }}"></script>
<script>
   $('#college').dropdown();
   $('#semester').dropdown();
   $('#course').dropdown({
     placeholder:'Select the course',
     useLabels: false
   });
   var a = $('#contexts').select2({
     'placeholder':'Select the course',
   });
      
       
   $('#contexts').on('change',function(){
         console.log(a);
         console.log(a.children);
   });
       
   
    
   $('#extra_charges,#discount,#fees').on('input', function() {
     this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
   });
   
   $('#extra_charges,#discount,#fees').on('blur',function(){
   
      
     calculateall();

   
   });
   function calculateall()
   {
    var total_fees = parseFloat($('#total_fees').val());
    
    var dom_fees = parseFloat($("#fees").val());

    

    var course_fees = parseFloat($('#course_fees').val());

    $('#discount').val(course_fees-dom_fees);
   
    var dom_discount = parseFloat($('#discount').val());
   
    var dom_extra_charges = parseFloat($('#extra_charges').val());
   
    
   
      var dom_total_fees = course_fees+dom_extra_charges-dom_discount;

      $('#discount').val(course_fees-dom_fees);

       $('#total_fees').val(dom_total_fees);
       console.log(course_fees);
       console.log(dom_extra_charges);
      console.log(dom_discount);
            
   
      
   }
   $('#registration_amount').blur(function(){

         var due_fees = parseFloat($('#total_fees').val())-parseFloat($(this).val());
         $('#due_fees').val(due_fees);
   });
       $('#course').on('change',function(){
               
               var id = $(this).val();
               $.ajax({
                   'url':'{{ route("api.course.getcourse") }}',
                   'method':'GET',
                   'data':{
                      
                       "course_id":id,
                   },
                   success:function(res){
                     
                     $('#total_fees').val(parseFloat(res["fees"]));
                     $('#course_fees').val(parseFloat(res["fees"]));
                     $('#fees').val(parseFloat(res["fees"]));
                   
                     
   
                     
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
                       
                         options += `<option value='${res[i]['id']}' selected>${res[i]['context']}</option>`;
   
                     }
                    
                     $('#contexts').html(options);
              
                   },
                   error:function(){
                       console.log("course not found");
                   }
               });
       });
   
     
   
     
   
       
</script>
@endsection