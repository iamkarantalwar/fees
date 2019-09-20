@extends('admin.layout')
@section('context')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
    <script>
      demo.showNotification('top','center','{{ Session::get($msg) }}','{{ $msg }}')
    </script>
   
    @endif
  @endforeach
<div class="col-md-12" id="context" style="display:none;">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Add Duration</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.duration.store') }}" method="POST">
                    @csrf
                 
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Duration</label>
                        <input type="text" class="form-control" placeholder="Enter Duration" name="duration" required >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Duration Code</label>
                        <input type="text" class="form-control" placeholder="Enter Duration Code" name="code" required >
                      </div>
                    </div>
                  </div>
                  
                    
                   
                  
                  <div class="row">
                
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">Add Duration</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

<div class="card">
 
              <div class="card-header">
              <h2 class="pull-left">Durations</h1>
             
              <button class="btn-outline-primary btn-lg btn-round pull-right" id="addcon">Add Duration</button>
         
                <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr><th>
                        Sr No
                      </th>
                      <th>
                        Duration Name
                      </th>
                      <th>
                        Update
                      </th>
                      <th>
                        Delete
                      </th>
                    </tr></thead>
                    <tbody>
                      <?php $i=1; ?>
                     @foreach($durations as $duration)
                      <tr>
                          <th>{{ $i }}</th>

                          <th>{{ $duration ->name }}</th>

                          <td>
                            <a href="{{ route('admin.duration.edit',['duration'=>$duration->id]) }}">
                              <button type="submit" class="btn btn-outline-warning">Edit Duration</button>
                            </a>
                          </td>

                          <td>
                            <form class="deleteform" action="{{ route('admin.duration.destroy',['duration'=>$duration->id]) }}" method="POST">
                              @csrf
                              @method('DELETE')                           
                              <button type="submit"  class="btn btn-outline-danger">Delete Duration</button>
                            </td>
                            </form>
                      </tr>
                      <?php $i++; ?>
                     @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              </div>
              
            </div>
<script>
  $('#addcon').on('click',function(){
      $('#context').toggle();
  });
  $('.deleteform').on('submit',function(e){

e.preventDefault();
swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this duration information!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
})
    .then((willDelete) => {
    if (willDelete) {
        
        $(this).submit();
    } else {
        swal("Your Duration information is safe!");
        return false;
    }
    });
});
  </script>
@endsection

 