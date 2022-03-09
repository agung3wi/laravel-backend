<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStatusCode()
    {
        $productCode = rand(10000, 99999);
        $response = $this->postJson('/product', [
            'product_name' => 'Mesin Cuci LG',
            'product_sku' => $productCode,
            'description' => 'Mesin Cuci'
        ]);

        $response->assertStatus(201);
    }

    public function testData()
    {
        $productCode = rand(10000, 99999);
        $expectBeforeCount = Product::count();
        $response = $this->postJson('/product', [
            'product_name' => 'Mesin Cuci LG',
            'product_sku' => $productCode,
            'description' => 'Mesin Cuci'
        ]);

        $expectAfterCount = Product::count();

        $check = $expectAfterCount - $expectBeforeCount == 1;
        $this->assertTrue($check);
    }

    public function testUniqueData()
    {
        $productCode = rand(10000, 99999);

        $product = new Product();
        $product->product_name = 'Mesin Cuci LG';
        $product->product_sku = $productCode;
        $product->description = "Halo Mesin Cuci";
        $product->save();

        $response = $this->postJson('/product', [
            'product_name' => 'Mesin Cuci LG 900120',
            'product_sku' => $productCode,
            'description' => 'Mesin Cuci'
        ]);

        $response->assertStatus(422)
            ->assertJson([
                "message" => "Product SKU with code $productCode already exists"
            ]);
    }
}
