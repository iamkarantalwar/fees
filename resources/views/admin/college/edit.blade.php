@extends('admin.assets')

@section('context')

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
    <script>
      demo.showNotification('top','center','{{ Session::get($msg) }}','{{ $msg }}')
    </script>
   
    @endif
@endforeach
<style>
    small{
        color:red;
    }
</style>
<div class="col-md-12" id="context" style="">

    <div class="card card-user">
        <div class="card-header">
        <h5 class="card-title">Edit College</h5>
        </div>
        <div class="card-body">
        <form action="{{ route('admin.college.update',['id'=>$college->id]) }}" method="POST">
            @method('PATCH')  
            @csrf           
            
            <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label>College Name</label>
                
                <input type="text" class="form-control" value="{{ $college->college_name }}"
                name="college_name" required="">
                @if($errors->has('college_name'))
                    <small>*This college already exist with us.</small>
                @endif
                </div>
                
            </div>
            </div>
            
            
            
            
            <div class="row">
        
            <div class="update ml-auto mr-auto">
                <button type="submit" class="btn btn-primary btn-round">Update College</button>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection