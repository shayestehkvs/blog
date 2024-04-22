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
                                url:'/admin/delete-order/'+ delete_id,
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
                            <th> Name </th>
                            <th> Email </th>
                            <th> Phone </th>
                            <th> Product title </th>
                            <th> Quantity </th>
                            <th> Price </th>
                            <th> Payment status </th>
                            <th> Delivery status </th>
                            <th> Print pdf </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <input type="hidden" class="delete_val" value="{{$order->id}}">
                                <td> {{$order->id}} </td>
                                <td>
                                    <img src="/product_image/{{$order->image}}" alt="{{$order->title}}">
                                </td>
                                <td> {{$order->name}} </td>
                                <td> {{$order->email}} </td>
                                <td> {{$order->phone}} </td>
                                <td> {{$order->product_title}} </td>
                                <td> {{$order->quantity}} </td>
                                <td> {{$order->price}} </td>
                                <td> {{$order->payment_status}} </td>
                                <td> {{$order->delivery_status}} </td>
                                <td> <a href="{{ route('edit-order', $order->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger deletebtn">Delete</button>
                                </td>
                                <td> <a href="{{ route('print-pdf', $order->id) }}" class="btn btn-sm btn-success">Print pdf</a>
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

