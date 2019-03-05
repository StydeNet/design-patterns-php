<?php

namespace Styde\Factories;

use Styde\Models\Product;
use Styde\Models\BaseModel;

class ProductFactory extends Factory
{
    protected function makeModel(): BaseModel
    {
        return new Product;
    }
}