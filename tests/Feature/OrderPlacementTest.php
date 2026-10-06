<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderPlacementTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_valid_web_order_is_saved_and_redirects(): void
    {
        $response = $this->post(route('orders.store'), [
            'customer_name' => 'Jane Doe',
            'customer_email' => 'jane@example.com',
            'product_name' => 'Notebook',
            'quantity' => 2,
            'unit_price' => '12.50',
        ]);

        $response->assertRedirect(route('orders.create'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('orders', [
            'customer_email' => 'jane@example.com',
            'product_name' => 'Notebook',
            'quantity' => 2,
            'total_amount' => '25.00',
            'status' => 'pending',
        ]);
    }

    public function test_an_api_order_returns_the_created_order(): void
    {
        $response = $this->postJson('/api/orders', [
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
            'product_name' => 'Pen',
            'quantity' => 3,
            'unit_price' => '4.00',
        ]);

        $response->assertCreated()
            ->assertJsonPath('data.total_amount', '12.00')
            ->assertJsonPath('data.status', 'pending');
        $this->assertDatabaseCount('orders', 1);
    }

    public function test_invalid_order_data_is_rejected(): void
    {
        $response = $this->postJson('/api/orders', [
            'customer_name' => '',
            'customer_email' => 'not-an-email',
            'product_name' => 'Pen',
            'quantity' => 0,
            'unit_price' => '-1',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors([
                'customer_name',
                'customer_email',
                'quantity',
                'unit_price',
            ]);
        $this->assertDatabaseCount('orders', 0);
    }
}
