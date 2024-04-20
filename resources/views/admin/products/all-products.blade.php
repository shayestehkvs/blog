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
                                url:'/admin/delete-product/'+ delete_id,
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
                    <h4 class="card-title">Product List</h4>
                    <a class="btn btn-sm btn-success" href="{{route('create-product')}}">+ Create Product</a>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Image </th>
                            <th> Title </th>
                            <th> Description </th>
                            <th> Quantity </th>
                            <th> Price </th>
                            <th> Discount </th>
                            <th> Category Name </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr>
                            <input type="hidden" class="delete_val" value="{{$product->id}}">
                            <td> {{$product->id}} </td>
                            <td>
                                <img src="/product_image/{{$product->image}}" alt="{{$product->title}}">
                            </td>
                            <td> {{$product->title}} </td>
                            <td> {{$product->description}} </td>
                            <td> {{$product->quantity}} </td>
                            <td> {{$product->price}} </td>
                            <td> {{$product->discount_price}} </td>
                            <td> {{$product->category->categoryName}} </td>
                            <td> <a href="{{ route('edit-product', $product->id) }}" class="btn btn-sm btn-info">Edit</a>
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

