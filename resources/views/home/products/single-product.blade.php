@extends('home.master')

@section('content')
    <section class="arrival_section">
        <div class="container">
            <div class="box">
                <div class="arrival_bg_box">
                    <img src="/product_image/{{$product->image }}" alt="{{ $product->title }}" >
                </div>
                <div class="row">
                    <div class="col-md-6 ml-auto">
                        <div class="heading_container remove_line_bt">
                            <h2>
                                {{ $product->title }}
                            </h2>
                        </div>
                        <p style="margin-top: 20px;margin-bottom: 30px;">
                            {{ $product->description }}
                        </p>
                        <p>
                            @if($product->discount_price !=null)
                                <h6 style="color: red">
                                    discount : {{ $product->discount_price }}
                                </h6>
                                <h6 style="text-decoration: line-through">
                                    price : {{ $product->price }}
                                </h6>
                            @else
                            <h6>
                                price : {{ $product->price }}
                            </h6>
                            @endif
                        </p>
                            <form action="{{ route('add-card', $product->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" min="1" name="quantity" value="1" width="100px">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="submit" value="Add to cart" class="option-2">
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
