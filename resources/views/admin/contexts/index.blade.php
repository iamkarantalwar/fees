@extends('admin.layout')
@section('context')
@if(Session::has('success'))
<script>
    demo.showNotification('top','center','<b>Context</b> has been Added.','primary')
</script>
@endif
@if(Session::has('danger')) 
<script>  
    demo.showNotification('top','center','<b>Context</b> has been Deleted.','danger')
</script>
@endif
<div class="col-md-12" id="context" style="display:none;">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Add Context</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.context.store') }}" method="POST">
                    @csrf
                 
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Context Name</label>
                        <input type="text" class="form-control" placeholder="Enter Context" name="context" required >
                      </div>
                    </div>
                  </div>
                  
                    
                   
                  
                  <div class="row">
                
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">Add Context</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

<div class="card">
 
              <div class="card-header">
              <h2 class="pull-left">Context</h1>
             
              <button class="btn-outline-primary btn-lg btn-round pull-right" id="addcon">Add Context</button>
         
                <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr><th>
                        Sr No
                      </th>
                      <th>
                        Context Name
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
                     @foreach($contexts as $context)
                      <tr>
                          <th>{{ $i }}</th>

                          <th>{{ $context ->context }}</th>

                          <td>
                            <a href="{{ route('admin.context.edit',[''=>$context->id]) }}">
                              <button type="submit" class="btn btn-outline-warning">Update Context</button>
                            </a>
                          </td>

                          <td>
                            <form action="{{ route('admin.context.destroy',[''=>$context->id]) }}" method="POST">
                              @csrf
                              @method('DELETE')                           
                              <button type="submit" class="btn btn-outline-danger">Delete Context</button>
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
  </script>
@endsection

 