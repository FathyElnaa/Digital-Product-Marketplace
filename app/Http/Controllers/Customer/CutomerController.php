<?php

namespace App\Http\Controllers\Customer;

use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Laravel\Prompts\Prompt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CutomerController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'approved')->latest()->take(10)->get();
        $topSellings =  Product::withCount('orderItems')->wherehas('orderItems',function($q){
            $q->where('status', 'completed');
        })->orderByDesc('order_items_count')
            ->take(10)
            ->get();

        return view('customer.home', compact('products', 'topSellings'));
    }

    public function profile()
    {
        $user = Auth::user();

        return view('customer.profile', compact('user'));
    }
    // public function orders()
    // {
    //     // Logic to fetch customer orders
    //     return view('customer.orders');
    // }
    public function accountDetails()
    {
        $user = Auth::user();

        return view('customer.account_details', compact('user'));
    }

    public function AllProducts()
    {
        // $products = Product::where('status', 'approved')->orderBy('id', 'asc')->paginate(20);  livewire
        return view('customer.All_Products');
    }

    public function ProductsByCategroy($id)
    {
        $products = Product::where('status', 'approved')->where('category_id', $id)->orderBy('id', 'asc')->paginate(10);
        return view('customer.ProductsByCategory', compact('products'));
    }

    public function OneProduct(Product $product)
    {
        $Related_Products = Product::where('category_id', '=', $product->category_id)->where('id','!=',$product->id)->take(4)->get();
        $reviews=Review::where('product_id',$product->id)->latest()->take(4)->get();

        return view('customer.product_preview', compact('product','Related_Products','reviews'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $products = Product::where('status', 'approved')
            ->where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
            ->paginate(20);

        return view('customer.search', compact('products', 'searchTerm'));
    }


}
