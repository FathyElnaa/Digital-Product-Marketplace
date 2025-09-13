<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart as CartModel; // 👈 عملت Alias هنا


class Cart extends Component
{
    public $count;

    public function mount()
    {
        $this->count = CartModel::where('user_id', Auth::id())->count();
    }
    public function add($productId)
    {
        $product = Product::findOrFail($productId);

        $exists = CartModel::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($exists) {
            session()->flash('info', 'المنتج موجود بالفعل في سلة التسوق!');
            return;
        }

        CartModel::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id
        ]);

        // تحديث العدد
        $this->count = CartModel::where('user_id', Auth::id())->count();

        session()->flash('success', 'تمت إضافة المنتج إلى سلة التسوق!');
    }

    public function remove($productId)
    {
        $cartItem = CartModel::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->delete();

            // تحديث العدد
            $this->count = CartModel::where('user_id', Auth::id())->count();

            session()->flash('success', 'تمت إزالة المنتج من سلة التسوق!');
        }
    }


    public function render()
    {
        $cartItems = CartModel::where('user_id', Auth::id())->with('product')->get();

        return view('livewire.cart', ['cartItems' => $cartItems]);
    }
}
