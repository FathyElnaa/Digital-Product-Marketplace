<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdminMiddleWare;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsVendorMiddleware;
use App\Http\Middleware\IsCustomerMiddleware;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\Vendor\ProductsController;
use App\Http\Controllers\Customer\CutomerController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\customer\WishlistController;
use App\Http\Controllers\Customer\RefundRequestController;
use App\Http\Controllers\Admin\AdminRefundRequestController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/***********
Admin Routes
 ************/

Route::middleware(['auth', 'verified', IsAdminMiddleWare::class])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/totalSalesToday', [AdminController::class, 'totalSalesToday'])->name('dashboard.totalSalesToday');
    Route::get('/profile', [AdminController::class, 'showprofile'])->name('profile');
    Route::get('/pending-products', [AdminController::class, 'pendingProducts'])->name('products.pending');
    Route::get('/products/{product}/approve', [AdminController::class, 'approve'])->name('products.approve');
    Route::get('/products/{product}/reject', [AdminController::class, 'reject'])->name('products.reject');
    Route::resource('users', UserController::class);
    route::resource('categories', CategoryController::class);
    Route::get('/refund-requests', [AdminRefundRequestController::class, 'index'])->name('refund_requests.index');
    Route::get('/FAQs', function () {
        return view('admin.FAQs');
    })->name('FAQs');

    // Route::post('/refunds/{refund_request}/approve', [AdminRefundRequestController::class, 'approve'])->name('refunds.approve');
    // Route::post('/refunds/{refund_request}/reject', [AdminRefundRequestController::class, 'reject'])->name('refunds.reject');
});



/************
Vendor Routes
 *************/

Route::middleware(['auth', 'verified', IsVendorMiddleware::class])->prefix('vendor')->group(function () {
    Route::get('/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('vendor.logout');
    Route::get('/profile', [VendorController::class, 'profile'])->name('vendor.profile');
    Route::resource('products', ProductsController::class)->names('vendor.products');
    Route::get('/reviews', [VendorController::class, 'reviews'])->name('vendor.reviews');
    Route::post('/reviews/{id}/reply', [VendorController::class, 'reply'])->name('vendor.reviews.reply');
    Route::get('/orders', [VendorController::class, 'orders'])->name('vendor.orders');
    Route::get('/FAQs', function () {
        return view('vendor.FAQs');
    })->name('vendor.FAQs');
});



/**************
 Customer Routes
 **************/

Route::prefix('customer')->group(function () {
    Route::get('/dashboard', [CutomerController::class, 'index'])->name('customer.dashboard');

    // Auth Routes
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('customer.login');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('customer.logout')->middleware('auth', 'verified', IsCustomerMiddleware::class);

    //Profile & Account Details Routes
    Route::get('/profile', [CutomerController::class, 'profile'])->name('customer.profile');
    Route::get('/account-details', [CutomerController::class, 'accountDetails'])->name('customer.account_details');

    //Show Products Routes
    Route::get('/products/AllProducts', [CutomerController::class, 'AllProducts'])->name('customer.all_products');
    Route::get('/products/Category/{id}', [CutomerController::class, 'ProductsByCategroy'])->name('customer.ProductsByCategroy');
    Route::get('/products/{product}', [CutomerController::class, 'OneProduct'])->name('customer.product_preview');

    //Order Routes
    Route::post('/orders/{product}', [OrderController::class, 'store'])->name('orders.store')->middleware('auth', 'verified', IsCustomerMiddleware::class);
    Route::get('/orders/success/{product}', [OrderController::class, 'success'])->name('orders.success')->middleware('auth', 'verified', IsCustomerMiddleware::class);
    Route::get('/orders/cancel/{product}', [OrderController::class, 'cancal'])->name('orders.cancel')->middleware('auth', 'verified', IsCustomerMiddleware::class);
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'OrderItem'])->name('orders.OrderItem');
    Route::get('/orders/{order}/{order_item}', [OrderController::class, 'OneOrder'])->name('customer.OneOrder')->middleware('auth', 'verified', IsCustomerMiddleware::class);

    //Wishlist & Reviews & Search Routes
    Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('customer.wishlist');
    Route::post('/wishlist/{product}', [WishlistController::class, 'store'])->name('wishlist.store')->middleware('auth', 'verified', IsCustomerMiddleware::class);
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/search', [CutomerController::class, 'search'])->name('products.search');

    // Cart Routes
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add')->middleware('auth', 'verified', IsCustomerMiddleware::class);
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    //Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth', 'verified', IsCustomerMiddleware::class);
    Route::post('/checkout/payment', [CheckoutController::class, 'processPayment'])->name('checkout.process')->middleware('auth', 'verified', IsCustomerMiddleware::class);
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success')->middleware('auth', 'verified', IsCustomerMiddleware::class);
    Route::get('/checkout/cancal', [CheckoutController::class, 'cancal'])->name('checkout.cancal')->middleware('auth', 'verified', IsCustomerMiddleware::class);

    // Refund Request Routes
    Route::get('/orders/{order}/{order_item}/refund-request', [RefundRequestController::class, 'create'])->name('customer.refund.create')->middleware('auth', 'verified', IsCustomerMiddleware::class);
    Route::post('/orders/{order}/{order_item}/refund-request', [RefundRequestController::class, 'store'])->name('customer.refund.store')->middleware('auth', 'verified', IsCustomerMiddleware::class);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
