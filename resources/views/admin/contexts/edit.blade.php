@extends('admin.layout')
@section('context')
@if(Session::has('success'))
<script>
    demo.showNotification('top','center','Context has updated.','primary')
</script>
@endif
<div class="col-md-12">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Edit Context</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.context.update',['id'=>$context->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                 
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Context Name</label>
                        <input type="text" class="form-control" placeholder="Enter Context" value="{{ $context->context }}" name="context" required >
                      </div>
                    </div>
                  </div>
                  
                    
                   
                  
                  <div class="row">
                
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-outline-primary btn-round">Edit Context</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
@endsection