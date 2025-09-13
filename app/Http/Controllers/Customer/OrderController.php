<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Download;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {

        $orders = Order::where('user_id', Auth::id())->latest()->get();
        $user = Auth::user();
        return view('customer.AllOrders', ['orders' => $orders, 'user' => $user]);
    }

    public function OrderItem(Order $order)
    {
        $orderItems = OrderItem::where('order_id', $order->id)->with('product')->get();
        return view('customer.orders_item', compact('orderItems', 'order'));
    }

    public function OneOrder(Order $order, OrderItem $order_item)
    {
        return view('customer.one_order', compact('order_item', 'order'));
    }

    public function store(Product $product)
    {
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        $line_items[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => ['name' => $product->title],
                'unit_amount' => $product->price * 100,
            ],
            'quantity' => 1,
        ];
        // dd($line_items);

        $session = $stripe->checkout->sessions->create([
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('orders.success', $product->id),
            'cancel_url' => route('orders.cancel', $product->id),
        ]);
        return redirect($session->url);
    }

    public function success(Product $product)
    {


        $totalAmount = $product->price * 1;

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalAmount,
            'status' => 'completed',
            'payment_status' => 'paid',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'vendor_id' => $product->vendor_id,
            'price' => $product->price,
            'status' => 'completed',
            'payment_status' => 'paid',
            'quantity' => 1,
        ]);

        return redirect()->route('orders.index')->with('success', 'تم الدفع بنجاح والطلب مكتمل.');
    }

    public function cancal(Product $product)
    {
        $totalAmount = $product->price * 1;

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalAmount,
            'status' => 'cancelled',
            'payment_status' => 'unpaid',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'vendor_id' => $product->vendor_id,
            'price' => $product->price,
            'status' => 'cancelled',
            'payment_status' => 'unpaid',
            'quantity' => 1,
        ]);
        return redirect()->back()->with('success', 'تم إلغاء الطلب بنجاح.');
    }
}
