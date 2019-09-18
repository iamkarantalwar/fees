@extends('admin.layout')
@section('context')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
    <script>
      demo.showNotification('top','center','{{ Session::get($msg) }}','{{ $msg }}')
    </script>
   
    @endif
  @endforeach
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
                        <input type="text"
                        class="form-control   @if ($errors->has('context')) invalidform  @endif" placeholder="Enter Context" value="{{ $context->context }}" name="context" required >
                  
                        @if ($errors->has('context'))
                        <small style="color:red">*Context already exist.</small>
                        @endif
                      
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