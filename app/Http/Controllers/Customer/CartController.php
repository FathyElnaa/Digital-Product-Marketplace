<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use GuzzleHttp\Handler\Proxy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function add(Product $product)
    {

        $exists = Cart::where('user_id', Auth::id())->where('product_id', $product->id)->exists();
        if ($exists) {
            return redirect()->back()->with('info', 'المنتج موجود بالفعل في سلة التسوق!');
        }
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id
        ]);
        return redirect()->back()->with('success', 'تمت إضافة المنتج إلى سلة التسوق!');
    }

    public function remove(Product $product){
        $cartitem=Cart::where('user_id', Auth::id())->where('product_id', $product->id)->first();
        if($cartitem){
            $cartitem->delete();
            return redirect()->back()->with('success', 'تمت إزالة المنتج من سلة التسوق!');
        }
    }

    // public function index()
    // {
    //     $categories = Category::all();
    //     $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
    //     return view('customer.layouts.nav', compact('cartItems', 'categories'));
    // }



    //------------------------

    
    //     // public function index()
    //     // {
    //     //     $categories = Category::all();
    //     //     $cart = session()->get('cart', []);
    //     //     return view('customer.cart', compact('cart', 'categories'));
    //     // }
    //     public function add(Product $product)
    //     {
    //         $cart = session()->get('cart', []);

    //         if (isset($cart[$product->id])) {
    //             return redirect()->back()->with('info', 'المنتج موجود بالفعل في سلة التسوق!');
    //         }
    //         $cart[$product->id] = [
    //             'title' => $product->title,
    //             'price' => $product->price,
    //             'quantity' => 1,
    //             'image' => $product->thumbnail,
    //             'vendor_id' => $product->vendor_id,
    //         ];


    //         session()->put('cart', $cart);

    //         return redirect()->back()->with('success', 'تمت إضافة المنتج إلى سلة التسوق!');
    //     }
    //     public function remove(Product $product)
    //     {
    //         $cart = session()->get('cart', []);

    //         if (isset($cart[$product->id])) {
    //             unset($cart[$product->id]);
    //             session()->put('cart', $cart);
    //         }

    //         return redirect()->back()->with('success', 'تمت إزالة المنتج من سلة التسوق!');
    //     }
}
