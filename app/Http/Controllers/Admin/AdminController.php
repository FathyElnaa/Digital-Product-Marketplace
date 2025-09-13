<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // This method can be used to show the admin dashboard or any admin-related content.
        $TotalCustomers = User::where('role', '!=', 'admin')->where('role', '!=', 'vendor')->count();
        $TotalVendors = User::where('role', '!=', 'admin')->where('role', '!=', 'customer')->count();
        // $totalUsersMonth = User::where('role', '!=', 'admin')->where('role', '!=', 'vendor')->where('created_at','>=',now()->subDay(30))->count();
        // $totalUsersYear = User::where('role', '!=', 'admin')->where('role', '!=', 'vendor')->where('created_at','>=',now()->subDay(365))->count();
        $totalProducts = Product::count();
        $totalOrders = OrderItem::where('status', 'completed')->count();
        $totalSales = OrderItem::where('payment_status', 'paid')->sum('price');
        $topSellings =  Product::withCount('orderItems')->wherehas('orderItems',function ($query){
            $query->where('status', 'completed');
        })->orderByDesc('order_items_count')->take(5)->get();

        // $topSellings =  Product::withCount(['order' => function ($query) {
        //     $query->where('status', 'completed');
        // }])
        //     ->orderByDesc('order_count')
        //     ->take(5)
        //     ->get();

        return view('admin.home', compact('TotalCustomers', 'TotalVendors', 'totalProducts', 'totalOrders', 'totalSales', 'topSellings'));
    }

    // public function totalSalesToday()
    // {
    //     $TotalCustomers = User::where('role', '!=', 'admin')->where('role', '!=', 'vendor')->count();
    //     $TotalVendors = User::where('role', '!=', 'admin')->where('role', '!=', 'customer')->count();
    //     $totalProducts = Product::count();
    //     $totalOrders = Order::count();

    //     $totalSalesToday = Order::where('payment_status', 'paid')->where('created_at', '>=', now()->subDay(1))->sum('total_price');
    //     return view('admin.home_Revenue_Today', compact('totalSalesToday', 'TotalCustomers', 'TotalVendors', 'totalProducts', 'totalOrders'));
    // }

    public function showprofile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user')); // Adjust the view path as necessary
    }

    public function pendingProducts()
    {
        $products = Product::where('status', 'pending')->with('vendor')->orderBy('id', 'asc')
            ->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function approve(Product $product)
    {
        $product->status = 'approved';
        $product->save();

        return back()->with('success', 'تمت الموافقة على المنتج');
    }

    public function reject(Product $product)
    {
        $product->status = 'rejected';
        $product->save();

        return back()->with('error', 'تم رفض المنتج');
    }
}
