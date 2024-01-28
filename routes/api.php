<?php


use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
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
        ->post('confirmation-password' , [RegisteredUserController::class , 'updatedPassword'])
        ->name('confirmation-password');
});



Route::middleware('auth:sanctum')->prefix('panel')->name('panel')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('supports', SupportController::class);
    Route::resource('products', ProductController::class)->except(['store']);
    Route::post('products/store_one', [ProductController::class , 'store_one'])->name('products.store_one');
    Route::put('products/store_two/{product}', [ProductController::class , 'store_two'])->name('products.store_two');
    Route::put('products/store_three/{product}', [ProductController::class , 'store_three'])->name('products.store_three');
    Route::put('products/store_four/{product}', [ProductController::class , 'store_four'])->name('products.store_four');
    Route::put('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('category-parent', [CategoryController::class  ,  'parent'])->name('parent');

    Route::put('products/update_one/{product}', [ProductController::class , 'update_one'])->name('products.update_one');
    Route::put('products/update_two/{product}', [ProductController::class , 'update_two'])->name('products.update_two');
    Route::put('products/update_three/{product}', [ProductController::class , 'update_three'])->name('products.update_three');
    Route::put('products/update_four/{product}', [ProductController::class , 'update_four'])->name('products.update_four');
    Route::put('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('category-parent', [CategoryController::class  ,  'parent'])->name('parent');
});
