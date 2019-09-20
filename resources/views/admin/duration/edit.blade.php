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
                <h5 class="card-title">Edit Duration</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.duration.update',['duration'=>$duration->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                 
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Duration</label>
                      <input type="text" class="form-control" placeholder="Enter Duration" name="duration" required value="{{$duration->name}}" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Duration Code</label>
                        <input type="text" class="form-control" placeholder="Enter COurse Code" name="code" required value="{{$duration->code}}">
                      </div>
                    </div>
                  </div>
                  
                    
                   
                  
                  <div class="row">
                
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">Update Duration</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
@endsection