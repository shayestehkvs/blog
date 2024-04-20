@component('admin.layout.content')
    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" ></script>
        <script>
            $('#ecf').validate({
                rules: {
                    productName : "required"
                },
                messages: {
                    productName: "Please enter product name"
                }
            })
        </script>
    @endsection
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('admin.layout.errors')
                <h4 class="card-title">Edit product</h4>
{{--                @dd($product)--}}
                <form id="ecf" class="form-inline" method="post" action="{{ route('update-product', $product->id) }}">
                    @csrf
                    @method('PUT')

                    <label class="sr-only" for="title">Product Title</label>
                    <input type="text" id="title" name="title" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" placeholder="Product name" value="{{ old('title', $product->title) }}">

                    <label class="sr-only" > Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Enter description" style="background-color: white !important; color: #0a0a0a !important;">{{old('description', $product->description) }}</textarea>

                    <label class="sr-only" for="price"> Price</label>
                    <input type="number" id="price" name="price" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" value="{{ old('price', $product->price) }}">

                    <label class="sr-only" for="discount"> Discount</label>
                    <input type="number" id="discount" name="discount_price" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" value="{{ old('discount_price', $product->discount_price) }}">

                    <label class="sr-only" for="quantity">Product Quantity</label>
                    <input type="text" id="quantity" name="quantity" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" placeholder="Product quantity" value="{{ old('quantity', $product->quantity) }}">

                    <label class="sr-only" for="category_id"> Categories</label>
                    <select name="category_id" id="category_id" class="form-control"  style="background-color: white !important; color: #0a0a0a !important;">
                        <option value=""> Add a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id ===$product->category_id ? 'selected' : '' }}>{{ $category->categoryName }}</option>
                        @endforeach
                    </select>

                    <label class="sr-only" for="image">Product Categories</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <img src="/product_image/{{ $product->image }}" alt="{{ $product->title }}" height="60px" class="mb-2 mt-2">
                    <br>
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endcomponent
