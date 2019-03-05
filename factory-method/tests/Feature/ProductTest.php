<?php

namespace Styde\Tests\Feature;

use Styde\Factories\ProductFactory;
use Styde\Tests\TestCase;
use Styde\Models\Product;

class ProductTest extends TestCase
{
    /** @test */
    function a_user_can_see_the_products_details()
    {
        $product = $this->createProduct([
            'title' => 'Curso de Patrones de Diseño'
        ]);

        $this->assertSame('Curso de Patrones de Diseño', $product->title);
    }

    /** @test */
    function a_user_can_see_the_product_is_in_stock()
    {
        $product = $this->createProduct([
            'stock' => true,
        ]);

        $this->assertTrue($product->stock);
    }

    /**
     * @return Product
     */
    protected function createProduct($attributes): Product
    {
        $factory = new ProductFactory;
        return $factory->createModel($attributes);
    }
}