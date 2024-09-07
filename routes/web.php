<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PaymentController;


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

Route::get('/', [FrontendController::class,'index'])->name('home');

Route::group(['middleware'=>'auth'], function(){
    Route::get('frontend/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::put('User/profile',[ProfileController::class,'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

});
//Route::middleware(['auth'])->group(function () {
//    Route::resource('admin/coupon', CouponController::class);
//});
//product details page
Route::get('/product/{slug}', [FrontendController::class, 'showProduct'])->name('product.show');



//Product Modal Route
Route::get('frontend/load-product-modal/{productId}', [FrontendController::class, 'loadProductModal'])->name('frontend.load-product-modal');

// Add to cart Route
Route::post('frontend/add-to-cart', [CartController::class, 'addToCart'])->name('frontend.add-to-cart');

Route::get('frontend/get-cart-products', [CartController::class, 'getCartProduct'])->name('frontend.get-cart-products');

Route::get('frontend/cart-product-remove/{rowId}', [CartController::class, 'cartProductRemove'])->name('frontend.cart-product-remove');

//Add to cart page  Route
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart-update-qty', [CartController::class, 'cartQtyUpdate'])->name('cart.quantity-update');
Route::get('/cart-destroy', [CartController::class, 'cartDestroy'])->name('cart.destroy');

//Coupon Routes

Route::post('frontend/apply-coupon', [FrontendController::class, 'applyCoupon'])->name('frontend.apply-coupon');
Route::get('frontend/destroy-coupon', [FrontendController::class, 'destroyCoupon'])->name('frontend.destroy-coupon');

Route::group(['middleware' => 'auth'], function(){
    Route::get('checkout',[CheckoutController::class, 'index'])->name('checkout.index');


Route::post('checkout', [CheckoutController::class, 'checkoutRedirect'])->name('checkout.redirect');



});
