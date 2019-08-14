@extends('admin.layout')
@section('context')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
    <script>
      demo.showNotification('top','center','{{ Session::get($msg) }}','{{ $msg }}')
    </script>
   
    @endif
  @endforeach


<div class="card">
   <div class="card-header">
      <h2 class="pull-left">Course</h2>
      <a href="{{ route('admin.course.create') }}">
      <button class="btn-outline-primary btn-lg btn-round pull-right" id="addcon">Add Course</button>
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
                        Course Name
                     </th>
                     <th>
                        Duration
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
                  <?php $i=1; ?>
                  @if(count($courses)>0)
                  @foreach($courses as $course)
                  <tr>
                     <th>{{ $i }}</th>
                     <th>{{ $course ->name }}</th>
                     <th>{{ $course ->duration }}</th>
                     <td>
                        <a href="{{ route('admin.course.edit',['course'=>$course->id]) }}">
                           <button class="btn btn-outline-primary">Edit</button>
                        </a>
                     </td>
                     <td>
                        <form action="{{ route('admin.course.destroy',['course'=>$course->id]) }}" method="POST">
                           @csrf
                           @method('DELETE')                           
                           <button type="submit" class="btn btn-outline-danger">Delete Course</button>
                        </form>
                     </td>                     
                  </tr>
                  <?php $i++; ?>
                  @endforeach
                  @endif                      
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

@endsection
