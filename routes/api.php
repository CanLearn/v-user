<?php


use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\ProductController;
use App\Http\Controllers\Panel\ProfileController;
use App\Http\Controllers\Panel\SupportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
    Route::middleware('auth:sanctum')
        ->post('confirmation-password', [RegisteredUserController::class, 'updatedPassword'])
        ->name('confirmation-password');
});

Route::middleware('auth:sanctum')->prefix('panel')->name('panel')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('video-landing', \App\Http\Controllers\Panel\VideolandingController::class);
    Route::resource('image-landing', \App\Http\Controllers\Panel\ImagelandingController::class);
    Route::resource('main-landing', \App\Http\Controllers\Panel\MainlandingController::class);
    Route::resource('footer-landing', \App\Http\Controllers\Panel\FooterlandingController::class);

    Route::resource('supports', SupportController::class);
    Route::resource('products', ProductController::class)->except(['store']);
    Route::post('products/store_one', [ProductController::class, 'store_one'])->name('products.store_one');
    Route::put('products/store_two/{product}', [ProductController::class, 'store_two'])->name('products.store_two');
    Route::put('products/store_three/{product}', [ProductController::class, 'store_three'])->name('products.store_three');
    Route::put('products/store_four/{product}', [ProductController::class, 'store_four'])->name('products.store_four');
    Route::put('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('category-parent', [CategoryController::class, 'parent'])->name('parent');
    Route::put('products-status-price/{product}/as/{status}', [ProductController::class, 'price_status_disable'])->name('products-status-disable-price');

    Route::put('products/update_one/{product}', [ProductController::class, 'update_one'])->name('products.update_one');
    Route::put('products/update_two/{product}', [ProductController::class, 'update_two'])->name('products.update_two');
    Route::put('products/update_three/{product}', [ProductController::class, 'update_three'])->name('products.update_three');
    Route::put('products/update_four/{product}', [ProductController::class, 'update_four'])->name('products.update_four');
    Route::put('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('category-parent', [CategoryController::class, 'parent'])->name('parent');
});

Route::name('front.')->group(function() {
    // Route::get('/fa/', [LandingController::class, 'index'])->name('index');
    Route::get('categories/en', [LandingController::class, 'categoriesEn'])->name('categoriesEn');
    Route::get('categories/fa', [LandingController::class, 'categoriesFa'])->name('categoriesFa');
    Route::get('headers/en', [LandingController::class, 'headerEn'])->name('headerEn');
    Route::get('headers/fa', [LandingController::class, 'headerFa'])->name('headerFa');

    Route::get('video/en', [LandingController::class, 'videoEn'])->name('videoEn');
    Route::get('video/fa', [LandingController::class, 'videoFa'])->name('videoFa');

    Route::get('image/en', [LandingController::class, 'imageEn'])->name('imageEn');
    Route::get('image/fa', [LandingController::class, 'imageFa'])->name('imageFa');

    Route::get('footer/en', [LandingController::class, 'footerEn'])->name('footerEn');
    Route::get('footer/fa', [LandingController::class, 'footerFa'])->name('footerFa');

    Route::get('/category-product/en/{slug}', [LandingController::class, 'category_product_en'])->name('category-product-en');
    Route::get('/category-product/fa/{slug}', [LandingController::class, 'category_product_fa'])->name('category-product-fa');

});
