@extends('admin.layout')
@section('context')
<style>
   .cursor{
      cursor:pointer;
   }
   </style>
<div class="col-md-12">
   <div class="card card-user">
      <div class="card-header">
         <h5 class="card-title">Search Registration</h5>
      </div>
      <div class="card-body">
         <form>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Registration ID</label>
                     <input type="text" class="form-control" name="registration_id" placeholder="Enter The Enquiry ID">
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Name</label>
                     <input type="text" class="form-control" name="name" placeholder="Enter The Name" >
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>College</label>
                     <input type="text" class="form-control" name="college" placeholder="Enter The College Name">
                  </div>
               </div>
               <div class="col-md-6 pl-1">
                  <div class="form-group">
                     <label>Semester</label>
                     <input type="text" class="form-control" name="semester" placeholder="Enter The Semester">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="update ml-auto mr-auto">
                  <button type="button" id="searchstudents" class="btn btn-primary btn-round">Search Students</button>
               </div>
               <button type="submit" style="display:none;"></button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header">
      <h2 class="pull-left">Registered Students With Fees</h2>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table">
               <thead class=" text-primary">
                  <tr>
                     <th>
                        Sr No
                     </th>
                     <th>
                        Student Name
                     </th>
                     <th>
                        Phone No
                     </th>
                     <th>
                        College
                     </th>
                     <th>
                        Course
                     </th>
                     <th>
                        Semester
                     </th>
                     <th>
                        Last Call
                     </th>
                     <th>
                        Status
                     </th>
                  </tr>
               </thead>
               <tbody id="tbody">
              
               <div class="modal fade" id="myModal" role="dialog">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                        </div>
                        <div class="modal-body">
                           <div class="embed-responsive embed-responsive-1by1">
                                 <iframe class="embed-responsive-item" id="model-route"  src="" allowfullscreen></iframe>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                     </div>
                  </div>
               </div>
               </tbody>
               
            </table>
         </div>
      </div>
   </div>
</div>
</div>
<script>

function changeModelRoute(id){
    var route = "{{ route('admin.calling.create',['enquiry_id'=>':id'])}}";
    route = route.replace("%3Aid",id);
    var model = $('#model-route').attr('src',route);
    $('#myModal').modal('show');
}

   window.route = {
       fetchstudents : "{{ route('api.fetchallregistrations') }}",
       filterstudents : "{{ route('api.filterregistrations') }}",
      
   }
</script>
<script src="{{ asset('assets/productjs/registration.js')}}"></script> 
@endsection
