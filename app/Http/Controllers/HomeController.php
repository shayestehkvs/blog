<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('home.index', compact('products'));
    }

    public function productDetail($id)
    {
        $product = Product::find($id);
        return view('home.products.single-product', compact('product'));
    }
    public function addToCard(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
//            dd($user);
            $product = Product::find($id);

            $cart = new Cart();
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;

            if ($product->discount_price) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }

            $cart->save();
            return redirect()->back();


        } else {
            return redirect('login');
        }
    }

    public function showCart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart_products = Cart::where('user_id', $id)->get();
            return view('home.cart.show-cart', compact('cart_products'));
        } else {
            return redirect('login');
        }
    }

    public function removeItemFromCart($id)
    {
        $cart_item = Cart::find($id);
        $cart_item->delete();
        return response()->json(['status'=> 'Cart Item removed']);

    }

//    public function redirect()
//    {
//        $user_type = Auth()->user()->userType;
//        if($user_type == '1') {
//            return view('admin.index');
//        } else {
//            return view('home.master');
//        }
//    }
}
