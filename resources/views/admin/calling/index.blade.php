@extends('admin.layout')
@section('context')
<div class="col-md-12">
   <div class="card card-user">
      <div class="card-header">
         <h5 class="card-title">Edit Profile Data</h5>
      </div>
      <div class="card-body">
         <form nonvalidate>
            <div class="row">
               <div class="col-md-6 pr-1">
                  <div class="form-group">
                     <label>Enquiry ID</label>
                     <input type="text" class="form-control" name="enquiry_id" placeholder="Enter The Enquiry ID">
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
                     <label>Enquiry Course</label>
                     <input type="text" class="form-control" name="semester" placeholder="Enter The enquiry Course">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="update ml-auto mr-auto">
                  <button type="button" id="searchstudents" class="btn btn-primary btn-round">Search Students</button>
               
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header">
      <h2 class="pull-left">Callings List</h2>
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
               </tbody>
               
            </table>
         </div>
      </div>
   </div>
</div>
</div>
<script>
    alert("hello world");
$('#searchstudents').click(function(){
    window.form = $('form').serialize();
    console.log(form);
})

   window.route = {
       fetchstudents : "{{ route('api.fetchallenquiries') }}",
       filterstudents : "{{ route('api.filterenquiries') }}"
   }
</script>
<!-- <script src="{{ asset('assets/productjs/calling.js')}}"></script>  -->
@endsection
