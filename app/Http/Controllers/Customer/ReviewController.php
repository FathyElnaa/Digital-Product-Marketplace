<?php

namespace App\Http\Controllers\Customer;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
         $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id'=>Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);


        return redirect()->back()->with('success', 'تم إضافة المراجعة بنجاح');
    }
}
