@extends('admin.assets')
@section('context')
<form action="{{ route('admin.password.checkauth')}}" method="POST">
@csrf
    <div class="form-group">
        <label>Enter Password</label>
        <input type="password" name="password" class="form-control"> 
    </div>
    <div class="form-group">
        <input type="submit" value="Confirm Password" class="form-control" class="form-control"> 
    </div>
   
</form>
@endsection