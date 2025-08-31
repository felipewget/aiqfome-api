<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductFavoriteController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;

Route::middleware('auth:api')->group(function () {
    Route::resource('/products/favorites', ProductFavoriteController::class)
        ->only(['index', 'store', 'destroy']);

    Route::delete('sessions', [SessionController::class, 'destroy']);
    
    Route::resource('users', UserController::class);
});

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/{productId}', [ProductController::class, 'show']);

Route::post('sessions', [SessionController::class, 'store']);