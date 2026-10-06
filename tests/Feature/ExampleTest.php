<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_home_page_shows_the_order_call_to_action(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Place an order')
            ->assertSee(route('orders.create'));
    }
}
