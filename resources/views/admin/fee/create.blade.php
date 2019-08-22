@extends('admin.assets')
@section('context')
@foreach (['danger', 'warning', 'success', 'info','primary'] as $msg)
    @if(Session::has($msg))
    <script>
      demo.showNotification('top','center','{{ Session::get($msg) }}','{{ $msg }}')
    </script>
   
    @endif
@endforeach
<div class="col-md-12">
   <div class="card card-user" id="addform">
      <div class="card-header">
         <h5 class="card-title">Add Fees Details</h5>
      </div>
      <div class="card-body">
         <form method="POST" action="{{ route('admin.fee.store') }}">
            @csrf
            <div class="addform">
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Registration ID</label>
                     <input type="text" class="form-control" name="registration_id" value="{{ $enquiry->id }}" readonly>
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Name</label>
                     <input type="text" class="form-control" name="name" value="{{ $enquiry->name }}" readonly>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>College</label>
                     <input type="text" class="form-control" name="college" value="{{ $enquiry->name }}" readonly>
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Semester</label>
                     <input type="text" class="form-control" name="semester" value="{{ $enquiry->semester }}" readonly>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Recipt No</label>
                     <input type="text" class="form-control" name="recipt_no" placeholder="Enter The Recipt No" required>
                  </div>
               </div>
            
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Fees</label>
                     <input type="text" class="form-control" name="payable_amount" value="0.00">
                  </div>
               </div>
            </div>
            <div class="row">
                <input type="buttons" id="sub-add-form" value="Enter Fees" class="btn btn-lg btn-outline-primary">
            </div>
            </div>
            <div class="row align-item-center" id="passwordverify" style="display:none;">
                <div class="col-md-6 pr-1">
                    <div class="form-group">
                        <label>Enter Password</label>
                        <input type="password" name="password" class="form-control" required> 
                        <br/>
                        <input type="submit" Value="Confirm Password" class="form-control btn btn-outline-success">
                    </div>
                </div>
               
            </div>
            
         </form>
      </div>
   </div>
   <div class="card card-user" id="editform" style="display:none">
      <div class="card-header">
         <h5 class="card-title">Edit Call Details</h5>
      </div>
      <div class="card-body">
         <form method="POST" action="" >
            @csrf
            @method('PUT')
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Enquiry ID</label>
                     <input type="text" class="form-control" name="enquiry_id" value="{{ $enquiry->id }}" readonly>
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Name</label>
                     <input type="text" class="form-control" name="name" value="{{ $enquiry->name }}" readonly>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>College</label>
                     <input type="text" class="form-control" name="college" value="{{ $enquiry->name }}" readonly>
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Semester</label>
                     <input type="text" class="form-control" name="semester" value="{{ $enquiry->semester }}" readonly>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Status</label>
                     <input type="text" class="form-control" name="status" placeholder="Enter The Status">
                  </div>
               </div>
            
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Narration</label>
                     <input type="text" class="form-control" name="narration" placeholder="Enter The Narration">
                  </div>
               </div>
            </div>
            <div class="row">
                  <input type="submit" value="Enter Details" class="btn btn-lg btn-outline-primary">
            </div>
         </form>
      </div>
   </div>
   <div class="card card-user" id="editform" style="display:none">
      <div class="card-header">
         <h5 class="card-title">Edit Call Details</h5>
      </div>
     
   </div>
   <div class="row">
   <div class="card-header col-md-12">
      <h2 class="pull-left">Fees Details</h2>
     
      <button class="btn btn-outline-success pull-right" id="addcall" style="display:none;">
               Add Fees
      </button>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table">
               <thead class=" text-primary">
                  <tr>
                     <th>
                        Installment No
                     </th>                    
                     <th>
                        Fees Paid
                     </th>
                     <th>
                        Pending Fees
                     </th>
                     <th>
                        Date And Time
                     </th>
                     <th>
                        Recipt Number
                     </th>
                     <!-- <th>
                        Edit
                     </th>
                     <th>
                        Delete
                     </th> -->
                  </tr>
               </thead>
               <tbody> 
               @if(count($enquiry->fees)>0)
                  @foreach($enquiry->fees as $fee)
                  <tr>
                     @if($loop->iteration==1)
                        <td>Registration</td>
                     @else
                        <td>{{ ($loop->iteration-1) }}</td>
                     @endif
                        <td>{{ $fee->payable_amount }}</td>
                        <td>{{ $fee->pending_amount }}</td>
                        <td>{{ $fee->created_at }}</td>
                        <td>{{ $fee->recipt_no }}                   

                  </tr>
                  @endforeach 
                  <tr style='background:yellow'>
                     <td><b>Total({{ $enquiry->total_fees }})</b></td>
                     <td>{{ $fees_paid }}</td>
                     <td> {{ $enquiry->total_fees - $fees_paid }}</td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
               @endif
               </tbody>
            </table>
         </div>
      </div>
   </div>
   </div>
</div>
<script>
  $('#sub-add-form').click(function(){
        $('.addform').hide();
        $('#passwordverify').show();
  });
  $('.fetchdata').click(function(){
     var tr = $(this).closest('tr');
     var td_data = tr.find('td');
     var status =tr.find('td:nth-child(2)').text().trim();
     var narration = tr.find('td:nth-child(3)').text().trim();
    
     var rout = "{{ route('admin.calling.update',['id'=>':id']) }}";
     rout = rout.replace(":id",tr.attr('id'));

     let form  = $('#editform').find('form');
     form.attr('action',rout);
     form.find('input[name=status]').val(status);
     form.find('input[name=narration]').val(narration);
   console.log(form);
      
     $('#editform').css('display','block');
     $('#addform').css('display','none');
     $('#addcall').css('display','block');
  });
  $('#addcall').click(function(){
     $('#editform').css('display','none');
     $('#addform').css('display','block');
     $(this).css('display','none');
  });
</script>
@endsection