@component('admin.layout.content')
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" ></script>
    <script>
        $('#ccf').validate({
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
                <h4 class="card-title">Create product</h4>
                <form id="ccf" class="form-inline" method="post" enctype="multipart/form-data" action="{{ route('store-product') }}">
                    @csrf
                    <label class="sr-only" for="title">Product Title</label>
                    <input type="text" id="title" name="title" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" placeholder="Product name">

                    <label class="sr-only" for="description"> Description</label>
                    <textarea name="description"class="form-control" cols="30" rows="5" placeholder="Enter description" style="background-color: white !important; color: #0a0a0a !important;"></textarea>

                    <label class="sr-only" for="price"> Price</label>
                    <input type="number" id="price" name="price" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" >

                    <label class="sr-only" for="discount"> Discount</label>
                    <input type="number" id="discount" name="discount_price" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" >

                    <label class="sr-only" for="quantity">Product Quantity</label>
                    <input type="text" id="quantity" name="quantity" class="form-control mb-2 mr-sm-2" style="background-color: white !important; color: #0a0a0a !important;" placeholder="Product name">

                    <label class="sr-only" for="category_id"> Categories</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value=""></option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                        @endforeach
                    </select>

                    <label class="sr-only" for="image">Product Categories</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endcomponent
