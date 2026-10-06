<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NiloyOrderify</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="site-shell">
        <main class="home-page">
            <nav class="topbar page-width" aria-label="Main navigation">
                <a class="brand" href="{{ route('home') }}"><span class="brand-mark">N</span><span>NiloyOrderify</span></a>
                <span class="topbar-note">Simple ordering</span>
            </nav>
            <section class="hero page-width">
                <div class="hero-copy reveal reveal-delay-1">
                    <p class="eyebrow"><span class="eyebrow-dot"></span> Orders made clear</p>
                    <h1>Order Ayhing you want form NiloyOrderify.</h1>
                    <p class="hero-lede">A calm, quick way to place your next order. Tell us what you need and we will take care of the rest.</p>
                    <a class="button button-primary" href="{{ route('orders.create') }}">Place an order <span aria-hidden="true">&rarr;</span></a>
                </div>
                <div class="hero-art reveal reveal-delay-2" aria-hidden="true">
                    <div class="orbit orbit-one"></div><div class="orbit orbit-two"></div>
                    <div class="art-card art-card-main"><span class="art-label">ORDER / 001</span><span class="art-line art-line-long"></span><span class="art-line art-line-short"></span><span class="art-total">Ready when you are.</span></div>
                    <div class="art-card art-card-float">01 <span>of</span> 01</div>
                </div>
            </section>
            <section class="home-details page-width reveal reveal-delay-3">
                <div><strong>01</strong><span>Choose what you need</span></div><div><strong>02</strong><span>Share the details</span></div><div><strong>03</strong><span>We confirm your order</span></div>
            </section>
        </main>
    </body>
</html>