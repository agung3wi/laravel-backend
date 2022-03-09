<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testStatusCode()
    {
        $response = $this->get('/product');
        $response->assertStatus(200);
    }

    public function testData()
    {
        $expectCount = Product::count();
        $response = $this->get('/product');
        $check = count($response["data"]) == $expectCount;
        $this->assertTrue($check);
    }
}
