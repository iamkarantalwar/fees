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
                <h5 class="card-title">Edit Degree</h5>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.degree.update',['id'=>$degree->id]) }}" method="POST">
                    @csrf
                    @method("PATCH")
                 
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Degree Name</label>
                      <input type="text" class="form-control @if ($errors->has('name')) invalidform  @endif" placeholder="Enter Degree" name="name" required value="{{ $degree->name }}">
                      @if ($errors->has('name'))
                        <small style="color:red">*Degree already exist.</small>
                        @endif
                    </div>
                    </div>
                  </div>
                  
                    
                   
                  
                  <div class="row">
                
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">Update Degree</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
@endsection