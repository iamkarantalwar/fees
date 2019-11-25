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
   .tooltip.top .tooltip-inner {
   background-color:red;
   }
   .tooltip.top .tooltip-arrow {
   border-top-color: red;
   }
   }
</style>
	
<link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">
<div class="col-md-12">
   <form action="{{ route('admin.registration.store') }}" id="myForm" onsubmit="return formValid()" method="POST" novalidate>
      <div class="card card-user">
         <div class="card-header">
            <h2 class="card-title">Add Registration</h2>
         </div>
         <div class="card-body">
            <div class="embed-responsive embed-responsive-16by9">
               <iframe class="embed-responsive-item" src="{{ route('admin.registration.form') }}" allowfullscreen></iframe>
             </div>
         </div>
      </div>
   </form>
</div>
<script src="{{ asset('assets/semantic/dist/semantic.min.js') }}"></script>
<script src="{{ asset('assets/select2/select2.min.js') }}"></script>
<script>
   function formValid(){
      var form = document.getElementById("myForm");
      var is_valid = form.checkValidity();
      
      if(is_valid)
      {
         return true;
      }
      swal("Please enter the necessary details.")
      return false;
   }
   $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();  
   })
   $('#college,#semester,#degree').dropdown({
        clearable: true,
        
    });
    
   
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
       
   $('#myModal').on('hidden.bs.modal', function (e) {
      e.preventDefault();
     let name= $('input[name="name"]').val();
     let gender = $('input[name="gender"]').val();
     let fname = $('input[name="fname"]').val();
   
      if(name.length>0 && gender.length>0 && fname.length>0){
         $("#stdinfo").removeClass("btn-danger");
         $("#stdinfo").addClass("btn-success");
      }
      else{
         $("#stdinfo").removeClass("btn-succes");
         $("#stdinfo").addClass("btn-danger");
      }
   });
   
   
   $('#myModal1').on('hidden.bs.modal', function (e) {
   
      e.preventDefault();
     let course= $('#course').val();
     let training_type = $('input[name="training_type"]').val();
    
   
      if(course>0 && training_type.length>0){
         $("#courseinfo").removeClass("btn-danger");
         $("#courseinfo").addClass("btn-success");
         
      }
      else{
         $("#courseinfo").removeClass("btn-succes");
         $("#courseinfo").addClass("btn-danger");
      }
   });
   $('#myModal4').on('hidden.bs.modal', function (e) {
   
   
   let registration_amount= $('#registration_amount').val();
   let recipt_num = $('#recipt_num').val();
   let installments = $('[name="installments"]').val();
   console.log(registration_amount);
   console.log(recipt_num);
   console.log(installments);
   if(registration_amount.length>0 && recipt_num.length>0 && installments.length>0){
    $("#feesinfo").removeClass("btn-danger");
    $("#feesinfo").addClass("btn-success");
    
   }
   else{
    $("#feesinfo").removeClass("btn-succes");
    $("#feesinfo").addClass("btn-danger");
   }
   });
   
   $('#myModal2').on('hidden.bs.modal', function (e) {
   
   e.preventDefault();
   let email= $('input[name="email"]').val();
   let phoneno = $("input[name='phoneno']").val();
   let address= $("#address").val();
   let relationship_type = $("[name='relation_type']").val();
   let alternate_phone = $("input[name='alternate_phone']").val();
   
   
   
   if(email.length>0 && phoneno.length>0 && address.length>0 
                     && relationship_type.length>0 &&  alternate_phone.length>0 ){
    $("#contactinfo").removeClass("btn-danger");
    $("#contactinfo").addClass("btn-success");
    
   }
   else{
    $("#contactinfo").removeClass("btn-succes");
    $("#contactinfo").addClass("btn-danger");
   }
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
   
               let duration= $(this).find("option:selected").text().split("-")[1];
              
               var id = $(this).val();
               $.ajax({
                   'url':'{{ route("api.course.getcourse") }}',
                   'method':'GET',
                   'data':{
                      
                       "course_id":id,
                   },
                   success:function(res){
                 console.log(res);
                     
                  var select = "<option selected='selected' value='"+res.duration_id+"'>"+duration+"</option>";
                     $("#duration").html(select);
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