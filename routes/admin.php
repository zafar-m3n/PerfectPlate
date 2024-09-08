

<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductOptionController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminForgotPasswordController;
use App\Http\Controllers\Admin\AdminResetPasswordController;
use App\Http\Controllers\Admin\CouponController;


//auth routes
Route::middleware('guest')->group(function () {
route::get('/admin/login',[AdminAuthController::class, 'index'])->name('admin.login');
});


Route::middleware([
    'auth'
])->prefix('admin')
    ->name('admin.')
    ->group(function () {

        route::get('/',[AdminDashboardController::class, 'index'])
            ->name('dashboard');


        //Coupon Routes
        Route::resource('coupon', CouponController::class);

    });



//profile controller
route::get('/profile',[ProfileController::class, 'index'])->name('admin.profile');

route::get('/profileUpdate',[ProfileController::class, 'updateProfile'])->name('admin.update');
Route::put('/profileUpdate', [ProfileController::class, 'updateProfile'])->name('admin.update');

Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('admin.update.password');

//slider routes
Route::resource('slider', SliderController::class);

//manage product category
Route::resource('category', CategoryController::class);

//manage product creation

Route::resource('product', ProductController::class)->except(['show']);
//order routes

Route::resource('order', OrderController::class)->except(['create', 'store']);

//manage product gallery
Route::get('product-gallery/{product}',[ProductGalleryController::class,'index'])->name('product-gallery.show-index');
Route::resource('product-gallery', ProductGalleryController::class);

//manage product size
Route::get('product-size/{product}',[ProductSizeController::class,'index'])->name('product-size.show-index');
Route::resource('product-size', ProductSizeController::class);

//manage product size
Route::resource('product-option', ProductOptionController::class);


//Route::resource('admin/coupon', CouponController::class)->names([
//    'index' => 'admin.coupon.index',
//]);
//Route::middleware(['auth'])->group(function () {
//    Route::post('admin/coupon/store', [CouponController::class, 'store'])->name('admin.coupon.store');
//});





//setting routes
Route::get('/setting',[SettingController::class,'index'])->name('admin.setting.index');

//setting routes
Route::get('admin/settings', [SettingController::class, 'index'])->name('admin.setting.index');
Route::put('admin/general-setting', [SettingController::class, 'UpdateGeneralSetting'])->name('admin.general-setting.update');




Route::get('password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
Route::post('password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
Route::get('password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
Route::post('password/reset', [AdminResetPasswordController::class, 'reset'])->name('admin.password.update');



