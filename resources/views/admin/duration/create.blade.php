@extends('admin.layout')
@section('context')
<div class="col-md-12">
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
                        <label>Duration</label>
                        <input type="text" class="form-control" placeholder="Enter Duration" name="duration" required >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Duration</label>
                        <input type="text" class="form-control" placeholder="Enter COurse Code" name="code" required >
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
@endsection