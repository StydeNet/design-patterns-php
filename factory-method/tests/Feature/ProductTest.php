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

    /** @test */
    function a_user_can_see_the_paginated_list_of_products()
    {
        $factory = new ProductFactory;

        $product1 = $factory->createModel([
            'title' => 'Producto Uno'
        ]);

        $products = $factory->createModels(18);

        $product20 = $factory->createModel([
            'title' => 'Producto Veinte'
        ]);
        $product21 = $factory->createModel([
            'title' => 'Producto Veintiuno'
        ]);

        $this->assertSame('Producto Uno', $product1->title);
        $this->assertCount(18, $products);
        $this->assertSame('Producto Veinte', $product20->title);
        $this->assertSame('Producto Veintiuno', $product21->title);

//        $this->get('products/?page=1')
//            ->assertSee('Producto Uno')
//            ->assertSee('Producto Veinte')
//            ->assertDontSee('Producto Veintiuno');
//            ->assertViewCollection('products')
//                ->contains($product1)
//                ->contains($product20)
//                ->notContains($product21);
    }

    /**
     * @param array $attributes
     * @return Product
     */
    protected function createProduct(array $attributes): Product
    {
        $factory = new ProductFactory;
        return $factory->createModel($attributes);
    }
}