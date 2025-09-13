<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\wishlist;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        // Paginator::useTailwind();    

        View::composer('customer/*', function ($view) {
            $categories = Category::all();
            $view->with('categories',$categories);
        });

        View::composer('*', function ($view) {
            $wishlistCount = 0;
            if (Auth::check()) {
                $wishlistCount = wishlist::where('user_id', Auth::id())->count();
            }
            $view->with('wishlistCount', $wishlistCount);
        });

        View::composer('*', function ($view) {
            $cartItems = [];
            if (Auth::check()) {
                $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
            }
            $view->with('cartItems', $cartItems);
        });

        View::composer('*', function ($view) {
            $cartCount = 0;
            if (Auth::check()) {
                $cartCount = Cart::where('user_id', Auth::id())->count();
            }
            $view->with('cartCount', $cartCount);
        });
    }
}
