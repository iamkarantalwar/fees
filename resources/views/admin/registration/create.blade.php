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
                <h2 class="card-title">Add Registration</h2>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.registration.store') }}" method="POST" nonvalidate>

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
                        <label>College</label>
                        <input type="text" class="form-control" name="college" required placeholder="Enter the college" 
                        value="{{ !empty($enquiry) ? $enquiry->college :'' }}">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Semester</label>
                        <input type="text" class="form-control" name="semester" required placeholder="Enter the semester" 
                        value="{{ !empty($enquiry) ? $enquiry->semester :'' }}">
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
                        <input type="text" class="form-control" readonly id="due_fees" name="due_fees" required placeholder="0.00" >
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
                </form>
              </div>
            </div>
          </div>
        
<script src="{{ asset('assets/semantic/dist/semantic.min.js') }}"></script>
<script src="{{ asset('assets/select2/select2.min.js') }}"></script>

<script>


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
    
var fees = 0;
var total_fees = 0;
var extra_charges = 0;
var discount =0;
 
$('#extra_charges,#discount,#fees').on('input', function() {
  this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
});

$('#extra_charges,#discount,#fees').on('keyup',function(){

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
    
    $('#course').on('change',function(){
            
            var id = $(this).val();
            $.ajax({
                'url':'{{ route("api.course.getcourse") }}',
                'method':'GET',
                'data':{
                   
                    "course_id":id,
                },
                success:function(res){
                  fees += parseFloat(res["fees"])
                  $('#fees').val(fees);
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
