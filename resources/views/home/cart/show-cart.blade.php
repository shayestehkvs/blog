@extends('home.master')

@section('content')
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
                                url:'/remove-cart-item/'+ delete_id,
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
    <section style="height: 100px; margin-top: 70px; margin-bottom: 100px;">
        <div class="container">
            <div class="container">
                <h1>Product list</h1>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php( $total_price =0 )
                    @foreach($cart_products as $product)
                        <tr>
                            <input type="hidden" class="delete_val" value="{{$product->id}}">
                            <td>{{ $product->product_title }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>$ {{$product->price}}</td>
                            <td>
                                <img src="/product_image/{{ $product->image }}" style="height: 30px;" alt="{{ $product->title }}">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-danger btn-sm deletebtn">Remove</button>
                            </td>
                        </tr>
                        @php($total_price = $total_price + $product->price)
                    @endforeach
                    </tbody>
                </table>
                <div>
                    <h1 class="text-center" style="font-size: 20px; font-weight: 500;">Total Price is ${{ $total_price }}</h1>
                </div>
                <div>
                    <h1 class="text-center" style="font-size: 20px; font-weight: 500;">Total Price is ${{ $total_price }}</h1>
                </div>
            </div>
        </div>
    </section>
@endsection
