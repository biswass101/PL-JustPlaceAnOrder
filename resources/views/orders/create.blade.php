<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Place an order | NiloyOrderify</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="site-shell">
        <main class="form-page page-width">
            <nav class="topbar" aria-label="Main navigation">
                <a class="brand" href="{{ route('home') }}"><span class="brand-mark">N</span><span>NiloyOrderify</span></a>
                <a class="back-link" href="{{ route('home') }}">&larr; Home</a>
            </nav>
            <section class="form-layout">
                <div class="form-intro reveal reveal-delay-1">
                    <p class="eyebrow"><span class="eyebrow-dot"></span> New order</p>
                    <h1>Let&apos;s make it official.</h1>
                    <p>Just a few details and your order will be on its way.</p>
                    <div class="form-aside"><span class="aside-number">01</span><span>Everything you enter stays focused on getting this order right.</span></div>
                </div>
                <div class="form-panel reveal reveal-delay-2">
                    <div id="toast-region" class="toast-region" aria-live="polite" aria-atomic="true"></div>
                    @if ($errors->any())
                        <div class="server-errors" data-server-errors>
                            @foreach ($errors->all() as $error)
                                <span>{{ $error }}</span>
                            @endforeach
                        </div>
                    @endif
                    <form method="POST" action="{{ route('orders.store') }}" data-order-form novalidate>
                        @csrf
                        <div class="field-grid">
                            <label class="field"><span>Customer name</span><input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Jane Doe" maxlength="255" autocomplete="name"></label>
                            <label class="field"><span>Email address</span><input type="email" name="customer_email" value="{{ old('customer_email') }}" placeholder="jane@example.com" maxlength="255" autocomplete="email"></label>
                        </div>
                        <label class="field"><span>What are you ordering?</span><input type="text" name="product_name" value="{{ old('product_name') }}" placeholder="e.g. Studio notebook" maxlength="255"></label>
                        <div class="field-grid">
                            <label class="field"><span>Quantity</span><input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="1000" inputmode="numeric"></label>
                            <label class="field"><span>Unit price <small>USD</small></span><input type="number" name="unit_price" value="{{ old('unit_price') }}" min="0.01" step="0.01" placeholder="0.00" inputmode="decimal"></label>
                        </div>
                        <button class="button button-primary button-submit" type="submit">Place order <span aria-hidden="true">&rarr;</span></button>
                    </form>
                </div>
            </section>
        </main>
    </body>
</html>