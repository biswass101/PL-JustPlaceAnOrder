<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/orders');

Route::get('/orders', [OrderController::class, 'create'])
    ->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])
    ->name('orders.store');
