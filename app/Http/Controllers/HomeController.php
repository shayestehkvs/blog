<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
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
    public function cashOrder()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart_info = Cart::where('user_id', $id)->get();

            foreach ($cart_info as $data) {
                $order = new Order();
                $order->name = $data->name;
                $order->email = $data->email;
                $order->phone = $data->phone;
                $order->address = $data->address;
                $order->user_id = $data->user_id;

                $order->product_title = $data->product_title;
                $order->price = $data->price;
                $order->quantity = $data->quantity;
                $order->image = $data->image;
                $order->product_id = $data->product_id;

                $order->payment_status = 'Cash on delivery';
                $order->delivery_status = 'processing';

                $order->save();

                $cart_id = $data->id;
                $cart = Cart::find($cart_id);
                $cart->delete();
            }
            Session()->flash('statusCode', 'success');
            return redirect(route('show-cart'))->with('status', 'We have received your order.');
        } else {
            return redirect()->back();
        }

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
