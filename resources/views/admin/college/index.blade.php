@extends('admin.layout')
@section('context')
<div class="row">
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                <div class="embed-responsive embed-responsive-1by1">
                    <iframe class="embed-responsive-item" id="model-route"  src="{{ route('admin.college.create') }}" allowfullscreen></iframe>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            
            </div>
        </div>
  
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title pull-left"> Colleges List</h4>
                <button class="pull-right btn btn-outline-primary" data-toggle="modal" data-target="#myModal">Add College</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <tr>
                                <th>
                                    Serial No
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Edit
                                </th>
                                <th>
                                    Delete
                                </th>                     
                            </tr>
                        </thead>
                        <tbody>

                        @if(count($colleges)>0)
                            @foreach($colleges as $college)
                            
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $college->college_name }}</td>
                                    <td>
                                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal{{$college->id}}">Edit</button>
                                            <div class="modal fade" id="myModal{{ $college->id }}" role="dialog">
                                                <div class="modal-dialog">                                                            
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title"></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="embed-responsive embed-responsive-1by1">
                                                                <iframe class="embed-responsive-item" id="model-route"  src="{{ route('admin.college.edit',['id'=>$college->id]) }}" allowfullscreen></iframe>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                            
                                                    </div>
                                                </div>
                                    </td>
                                    <td>
                                        <form class="deleteform" action="{{ route('admin.college.destroy',['id'=>$college->id]) }}" method="POST" >
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td>No Record is Available. </td>
                        </tr>
                        @endif
                        
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('.deleteform').on('submit',function(e){

    e.preventDefault();
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this college name!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
        if (willDelete) {
            
            $(this).submit();
        } else {
            swal("Your college detail is safe!");
            return false;
        }
        });
});
</script>
@endsection