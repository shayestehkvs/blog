<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;

class ProductController extends Controller
{
    public $product_repo;
    public function __constract(Product $product_repo)
    {
        $this->product_repo = $product_repo;
    }
    public function allProduct()
    {
        $products = $this->product_repo->getAll();
        return view('admin.products.all-products')->with('products', $products);
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.products.create-product')->with('categories', $categories);
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'quantity' => 'required|integer',
            'price' => 'required',
            'discount_price' => 'nullable|number',
            'category_id' => 'required',
        ]);
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->category_id = $request->category_id;
        $image = $request->image;
        $image_name = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product_image', $image_name);

        $product->image = $image_name;
        $product->save();
        Session::flash('statuscode', 'success');
        return redirect(route('all-products'))->with('status', 'Data saved');

    }
    public function editProduct($id)
    {
        $product = $this->product_repo->findById($id);
        $categories = Category::all();
        return view('admin.products.edit-product')->with('product', $product)->with('categories', $categories);
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required',
            'discount_price' => 'nullable|number',
            'category_id' => 'required',
        ]);
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->category_id = $request->category_id;
        $image = $request->image;
        if ($image) {
            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            ]);
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product_image', $image_name);
            $product->image = $image_name;
        }
        $product->save();
        Session()->flash('statusCode', 'success');
        return redirect(route('all-products'))->with('status', 'Data updated');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $file_path = public_path('product_image').'/'. $product->image;

        if (File::exists($file_path)) {
            File::delete($file_path);
            $product->delete();
        }
        return response()->json(['status'=> 'ProductRepo deleted successfully']);
    }
}
