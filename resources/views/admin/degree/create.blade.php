@extends('admin.layout')
@section('context')
<div class="col-md-12">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Add Degree</h5>
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
@endsection