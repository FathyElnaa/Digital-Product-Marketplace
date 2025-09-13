<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {

        $cart = Cart::where('user_id', Auth::id())->with('product')->get();
        $totalAmount = $cart->sum(function ($item) {
            return $item->product->price;
        });

        if (empty($cart)) {
            return redirect()->back()->with('error', 'الكارت فارغ.');
        }

        return view('customer.checkout', compact('cart', 'totalAmount'));
    }

    public function processPayment()
    {

        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'سلة التسوق فارغة.');
        }


        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        $line_items = [];
        foreach ($cart as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => $item->product->title],
                    'unit_amount' => $item->product->price * 100,
                ],
                'quantity' => 1,
            ];
        }

        $session = $stripe->checkout->sessions->create([
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancal'),
        ]);
        return redirect($session->url);
    }

    public function success()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cart->isEmpty()) {
            return redirect()->route('checkout.index')->with('error', 'سلة التسوق فارغة.');
        }

        // 🟢 إنشاء Order واحد فقط
        $totalAmount = $cart->sum(function ($item) {
            return $item->product->price * 1;
        });

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalAmount,
            'status' => 'completed',
            'payment_status' => 'paid',
        ]);

        // 🟢 إضافة العناصر (OrderItems)
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'vendor_id' => $item->product->vendor_id,
                'price' => $item->product->price,
                'status' => 'completed',
                'payment_status' => 'paid',
                'quantity' => 1,
            ]);
        }
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->route('orders.index')->with('success', 'تم الدفع بنجاح والطلب مكتمل.');
    }

    public function cancal()
    {
        return redirect()->route('checkout.index')->with('error', 'تم إلغاء عملية الدفع.');
    }
}
