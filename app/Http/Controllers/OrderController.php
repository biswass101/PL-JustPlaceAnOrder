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
    public function create(): View
    {
        return view('orders.create');
    }

    public function store(StoreOrderRequest $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validated();

        $order = Order::create([
            ...$validated,
            'total_amount' => $validated['quantity'] * $validated['unit_price'],
            'status' => 'pending',
        ]);

        if ($request->expectsJson()) {
            return (new OrderResource($order))
                ->response()
                ->setStatusCode(201);
        }

        return to_route('orders.create')->with('success', 'Your order was placed successfully.');
    }
}
