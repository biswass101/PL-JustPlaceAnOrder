<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Place an order</title>
        <style>
            :root { color-scheme: light; font-family: ui-sans-serif, system-ui, sans-serif; }
            body { background: #f4f5f7; color: #17202a; margin: 0; }
            main { margin: 4rem auto; max-width: 38rem; padding: 0 1.25rem; }
            section { background: #fff; border: 1px solid #dfe3e8; border-radius: .5rem; padding: 2rem; }
            h1 { margin-top: 0; }
            form { display: grid; gap: 1rem; }
            label { display: grid; gap: .35rem; font-weight: 600; }
            input { border: 1px solid #b8c0cc; border-radius: .25rem; box-sizing: border-box; font: inherit; padding: .7rem; width: 100%; }
            button { background: #1769aa; border: 0; border-radius: .25rem; color: #fff; cursor: pointer; font: inherit; font-weight: 700; padding: .75rem 1rem; }
            .errors { background: #fff1f0; border: 1px solid #f0a6a0; color: #8a1c13; margin-bottom: 1rem; padding: .75rem 1rem; }
            .success { background: #edf8ee; border: 1px solid #9bd0a1; color: #1d5e27; margin-bottom: 1rem; padding: .75rem 1rem; }
        </style>
    </head>
    <body>
        <main>
            <section>
                <h1>Place an order</h1>
                <p>Enter the customer and product details below.</p>

                @if (session('success'))
                    <div class="success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="errors">
                        <strong>Please correct the following:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf
                    <label>
                        Customer name
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" required maxlength="255">
                    </label>
                    <label>
                        Customer email
                        <input type="email" name="customer_email" value="{{ old('customer_email') }}" required maxlength="255">
                    </label>
                    <label>
                        Product name
                        <input type="text" name="product_name" value="{{ old('product_name') }}" required maxlength="255">
                    </label>
                    <label>
                        Quantity
                        <input type="number" name="quantity" value="{{ old('quantity', 1) }}" required min="1" max="1000">
                    </label>
                    <label>
                        Unit price
                        <input type="number" name="unit_price" value="{{ old('unit_price') }}" required min="0.01" step="0.01">
                    </label>
                    <button type="submit">Place order</button>
                </form>
            </section>
        </main>
    </body>
</html>