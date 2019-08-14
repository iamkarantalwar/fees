@extends('admin.layout')
@section('context')

<div class="col-md-12">
  <div class="card card-user">
      <div class="card-header">
          <h2 class="card-title">Add Course</h2>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.course.store') }}" method="POST">
          @csrf 
          <div class="row">
            <div class="col-md-5 pr-1">
              <div class="form-group">
                <label>Course Name</label>
                <input type="text" class="form-control"  name="course" placeholder="Enter Your Course Name" required>
              </div>
            </div>          
            <div class="col-md-6 px-1">
              <div class="form-group">
                <label>Duration</label>
                <input type="text" class="form-control" name="duration" placeholder="Enter course Duration" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5 pr-1">
                <div class="form-group">
                    <label>Fees</label><br/>
                    <input type="text" name="fees" placeholder="Enter the fees" required class="form-control">
                </div>
            </div>
            <div class="col-md-6 px-1">
                <div class="form-group">
                    <label>Context</label><br/>
                    <select class="ui search dropdown col-md-12" multiple="" placeholder="Enter the context" required name="contexts[]">
                        @if(count($contexts)>0)

                            @foreach($contexts as $context)

                                <option value="{{ $context->id }}">{{ $context->context }}</option>

                            @endforeach

                        @endif
                    </select>
                </div>
            </div>                
          </div>
          <div class="row">
            <div class="update ml-auto mr-auto">
              <button type="submit" class="btn btn-primary btn-round">Add Course</button>
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<script src="{{ asset('assets/semantic/dist/semantic.min.js') }}"></script>
<script>
$('.ui.dropdown')
  .dropdown({
    clearable: true,
    
  })
;
 
</script>
@endsection
  <!-- <div class="row">
                   <div class="ui animated button orange" tabindex="0">
      <div class="visible content">Horizontal</div>
      <div class="hidden content">
        Hidden
      </div>
    </div> -->