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
                <h5 class="card-title">Add Degree</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.degree.store') }}" method="POST">
                    @csrf
                 
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Degree Name</label>
                        <input type="text" class="form-control" placeholder="Enter Degree Name" name="name" required >
                      </div>
                    </div>
                  </div>
                  
                    
                   
                  
                  <div class="row">
                
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">Add Degree</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

<div class="card">
 
              <div class="card-header">
              <h2 class="pull-left">Degrees</h1>
             
              <button class="btn-outline-primary btn-lg btn-round pull-right" id="addcon">Add Degree</button>
         
                <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr><th>
                        Sr No
                      </th>
                      <th>
                        Degree Name
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
                     @foreach($degrees as $degree)
                      <tr>
                          <th>{{ $i }}</th>

                          <th>{{ $degree ->name }}</th>

                          <td>
                            <a href="{{ route('admin.degree.edit',['degree'=>$degree->id]) }}">
                              <button type="submit" class="btn btn-outline-warning">Update Degree</button>
                            </a>
                          </td>

                          <td>
                            <form class="deleteform" action="{{ route('admin.degree.destroy',['degree'=>$degree->id]) }}" method="POST">
                              @csrf
                              @method('DELETE')                           
                              <button type="submit"  class="btn btn-outline-danger">Delete Degree</button>
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
    text: "Once deleted, you will not be able to recover this degree information!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
})
    .then((willDelete) => {
    if (willDelete) {
        
        $(this).submit();
    } else {
        swal("Your degree information is safe!");
        return false;
    }
    });
});
  </script>
@endsection

 