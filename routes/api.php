<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiOrdersController;
use App\Http\Controllers\Api\ApiOrderItemController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiPaymentController;
use App\Http\Controllers\Api\ApiCustomerController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    
    Route::resource('api/orders', ApiOrdersController::class);
    Route::resource('api/order-items', ApiOrderItemController::class);
    Route::resource('api/products', ApiProductController::class);
    Route::resource('api/categories', ApiCategoryController::class);
    Route::resource('api/payments', ApiPaymentController::class);
    Route::resource('api/customers', ApiCustomerController::class);

    use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index']);       // Mendapatkan semua pengguna
Route::get('/users/{id}', [UserController::class, 'show']);   // Mendapatkan detail pengguna
Route::post('/users', [UserController::class, 'store']);      // Membuat pengguna baru
Route::put('/users/{id}', [UserController::class, 'update']); // Memperbarui pengguna
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Menghapus pengguna
