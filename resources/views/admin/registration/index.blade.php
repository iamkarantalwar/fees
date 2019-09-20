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
      <h2 class="pull-left">Registration</h2>
      <a href="{{ route('admin.registration.create') }}">
      <button class="btn-outline-primary btn-lg btn-round pull-right" id="addcon">Add Registration</button>
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
                     <th>
                        Registration Date
                     </th>
                  </tr>
               </thead>
               <tbody>

               </tbody>

               @if(count($registrations)>0)
                @foreach($registrations as $registration)
                    <tr data-href="{{ route('admin.registration.show',['registration'=>$registration->id]) }}" class="pointer">
                      <td> {{ $loop->iteration }}</td>
                      <td> {{ $registration->name }} </td>
                      <td> {{ $registration->phoneno }} </td>
                      <td> {{ $registration->college->college_name }} </td>
                   
                      <td> 
                          @foreach($registration->courses as $course)
                            {{ $course->name}}  <br/>
                          @endforeach
                      </td>
                      <td> {{ $registration->semester }}</td>
                      <td> {{ date("d/m/y",strtotime($registration->created_at)) }}</td>
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
