<?php

namespace App\Http\Controllers\customer;

use App\Models\Product;
use App\Models\Category;
use App\Models\wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\View\Components\Warn;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class WishlistController extends Controller
{
    public function wishlist()
    {

        $wishlist = wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('customer.wishlist', compact('wishlist'));
    }

    public function store(Product $product)
    {
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $product->id
        ]);
        return redirect()->back()->with('success', 'تمت الإضافة إلى المفضلة');
    }

    public function destroy($id)
    {
        Wishlist::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'تم الحذف من المفضلة');
    }
}
