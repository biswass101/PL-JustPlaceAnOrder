<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OrderController::class, 'home'])
    ->name('home');

Route::get('/orders', [OrderController::class, 'create'])
    ->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])
    ->name('orders.store');
Route::get('/orders/{order}/success', [OrderController::class, 'success'])
    ->name('orders.success');
