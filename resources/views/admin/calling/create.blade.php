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
         <h5 class="card-title">Add Call Details</h5>
      </div>
      <div class="card-body">
         <form method="POST" action="{{ route('admin.calling.store') }}">
            @csrf
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
   <div class="row">
   <div class="card-header col-md-12">
 
      <h2 class="pull-left">Call Details (+91 {{ $enquiry->phone_no }})</h2>
     
      <button class="btn btn-outline-success pull-right" id="addcall" style="display:none;">
               Add Call
      </button>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table">
               <thead class=" text-primary">
                  <tr>
                     <th>
                        Call No
                     </th>                    
                     <th>
                        Status
                     </th>
                     <th>
                        Narration
                     </th>
                     <th>
                        Date And Time
                     </th>
                     <th>
                        Edit
                     </th>
                     <th>
                        Delete
                     </th>
                  </tr>
               </thead>
               <tbody>
                  @if(count($enquiry->callings)>0)
                     @foreach($enquiry->callings as $call)
                        <tr id="{{ $call->id }}" class="call-deatails">
                           <td>
                              {{ $loop->iteration}}
                           </td>
                           <td>
                              {{ $call->status}}
                           </td>
                           <td>
                              {{ $call->narration }}
                           </td>
                           <td>
                              {{ $call->created_at }}
                           </td>
                           <td>
                              <button class="btn btn-md btn-outline-warning fetchdata" >
                                 EDIT
                              </button>     
                           </td>
                           <td>
                              <form action="{{ route('admin.calling.destroy',['id'=>$call->id]) }}" method="POST">
                                  @method('DELETE')
                                  @csrf
                                 <button type="submit" class="btn btn-md btn-outline-danger">
                                    DELETE
                                 </button>     
                              </form>
                           </td>
                        </tr>
                     @endforeach
                  @else
                     <tr>
                           <td>No Call Yet</td>
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