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
.pointer:hover
{
  cursor:pointer;
}

</style>

<div class="card">
   <div class="card-header">
      <h2 class="pull-left">Enquiry</h2>
      <a href="{{ route('admin.enquiry.create') }}">
      <button class="btn-outline-primary btn-lg btn-round pull-right" id="addcon">Add Enquiry</button>
      </a>
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
                  </tr>
               </thead>
               <tbody>

               </tbody>

               @if(count($enquiries)>0)
                @foreach($enquiries as $enquiry)
                    <tr data-href="{{ route('admin.enquiry.show',['enquiry'=>$enquiry->id]) }}" class="pointer">
                      <td> {{ $loop->iteration }}</td>
                      <td> {{ $enquiry->name }} </td>
                      <td> {{ $enquiry->phone_no }} </td>
                      <td> {{ $enquiry->college->college_name }} </td>
                   
                      <td> 
                          @foreach($enquiry->courses as $course)
                            {{ $course->name}}  <br/>
                          @endforeach
                      </td>
                      <td> {{ $enquiry->semester }}</td>
                    </tr>
                  @endforeach              
                
               @endif              
            </table>
         </div>
      </div>
   </div>
</div>
<script>
 $('.pointer').on('click',function(){
  window.location = $(this).data("href");
  
 });
   
</script>
@endsection
