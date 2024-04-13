@component('admin.layout.content')
    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.deletebtn').click(function (e) {
                    e.preventDefault();
                    var delete_id= $(this).closest("tr").find('.delete_val').val();
                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {

                            var data = {
                                "_token":$('input[name=_token]').val(),
                                "id" : delete_id
                            }

                            $.ajax({
                                type:"DELETE",
                                url:'/admin/delete-permission/'+ delete_id,
                                data : data,
                                success : function (response) {
                                    swal(response.status, {
                                        icon: "success",
                                    }).then((willDelete) => {
                                        location.reload();
                                    })
                                }
                            })

                        });
                });
            });
        </script>
    @endsection
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Permission List</h4>
                    <a class="btn btn-sm btn-success" href="{{route('create-permission')}}">Create Permission</a>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Permission name </th>
                            <th> Permission label </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)

                            <tr>
                                <input type="hidden" class="delete_val" value="{{$permission->id}}">
                                <td> {{$permission->id}} </td>
                                <td> {{$permission->name}} </td>
                                <td> {{$permission->label}} </td>
                                <td> <a href="{{ route('edit-permission', $permission->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger deletebtn">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endcomponent
