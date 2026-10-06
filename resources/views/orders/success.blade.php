<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Order confirmed | NiloyOrderify</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="site-shell">
        <main class="success-page page-width">
            <nav class="topbar" aria-label="Main navigation"><a class="brand" href="{{ route('home') }}"><span class="brand-mark">N</span><span>NiloyOrderify</span></a></nav>
            <section class="success-card reveal reveal-delay-1">
                <div class="success-icon" aria-hidden="true">&#10003;</div>
                <p class="eyebrow"><span class="eyebrow-dot"></span> Order confirmed</p>
                <h1>Thanks for the order, {{ Str::before($order->customer_name, ' ') }}.</h1>
                <p class="success-copy">Your order is safely in our hands. We&apos;ll use <strong>{{ $order->customer_email }}</strong> if we need to reach you.</p>
                <div class="order-summary"><div><span>Order</span><strong>#{{ str_pad((string) $order->id, 4, '0', STR_PAD_LEFT) }}</strong></div><div><span>Item</span><strong>{{ $order->product_name }} &times; {{ $order->quantity }}</strong></div><div><span>Total</span><strong>${{ number_format((float) $order->total_amount, 2) }}</strong></div></div>
                <a class="button button-secondary" href="{{ route('home') }}">Return to home <span aria-hidden="true">&larr;</span></a>
            </section>
        </main>
    </body>
</html>