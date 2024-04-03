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
                                url:'/delete-category/'+ delete_id,
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
                    <h4 class="card-title">Category List</h4>
                    <a class="btn btn-sm btn-success" href="{{route('create-category')}}">+ Create Category</a>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Category name </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <input type="hidden" class="delete_val" value="{{$category->id}}"
                            <td> {{$category->id}} </td>
                            <td> {{$category->categoryName}} </td>
                            <td> <a href="{{ route('edit-category', $category->id) }}" class="btn btn-sm btn-info">Edit</a>
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

