<?php

namespace App\Http\Controllers\Vendor;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index()
    {
        $salesCount = OrderItem::where('vendor_id', Auth::id())->where('payment_status', 'paid')->count();
        $totalSales = OrderItem::where('vendor_id', Auth::id())->where('payment_status', 'paid')->sum('price');
        $totalCustomerPurchased = Order::whereHas('orderItems', function ($query) {
            $query->where('vendor_id', Auth::id());
        })->distinct('user_id')->count('user_id');
        $totalProducts = Product::where('vendor_id', Auth::id())->count();
        $topSellings =  Product::where('vendor_id', Auth::id())->withCount('orderItems')->wherehas('orderItems',function ($query){
            $query->where('status', 'completed');
        })->orderByDesc('order_items_count')->take(5)->get();
        $recentSales = OrderItem::where('vendor_id', Auth::id())->with(['product', 'order.user'])->latest()->take(5)->get();
        return view('vendor.home',compact('salesCount', 'totalSales', 'totalCustomerPurchased', 'totalProducts', 'topSellings', 'recentSales'));
    }
    public function profile()
    {
        $user = Auth::user();
        return view('vendor.profile', compact('user'));
    }

    public function reviews()
    {
        $reviews = Auth::user()->products()->with('reviews')->get()->pluck('reviews')->flatten();
        return view('vendor.reviews.index', compact('reviews'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $review = \App\Models\Review::findOrFail($id);
        $review->reply = $request->input('reply');
        $review->save();

        return redirect()->route('vendor.reviews')->with('success', 'Reply added successfully.');
    }

    public function orders()
    {
        $orders = Order::with(['user', 'orderItems' => function ($query) {
            $query->where('vendor_id', Auth::id());
        }])->latest()->paginate(10);

        return view('vendor.orders.index', compact('orders'));
    }
}
