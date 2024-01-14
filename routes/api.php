<?php


use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\ProductController;
use App\Http\Controllers\Panel\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');

});


Route::middleware('auth:sanctum')->prefix('panel')->name('panel')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    Route::put('profile', [ProfileController::class, 'edit'])->name('profile.edit');
});
