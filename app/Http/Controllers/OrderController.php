<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function create(): View {
        return view('orders.create');
    }

    public function store(StoreOrderRequest $request): RedirectResponse | JsonResponse {
        $validated = $request->validated();
        $totalPrice = $validated['quantity'] * $validated['unit_price'];

        $order = Order::create([
            ...$validated_body,
            'total_amount' => $totalPrice,
            'status' => 'pending',
        ]);

        if($request->expectsJson()) return (new OrderResource($order))->response()->setStatusCode(201);
        
        return to_route('orders.create')->with(
            'success', 
            'Your order was placed successfully.'
        );
    }
}
