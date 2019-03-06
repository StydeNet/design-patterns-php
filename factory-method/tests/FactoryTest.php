<?php

namespace Styde\Tests;

use Styde\Models\BaseModel;
use Styde\Factories\Factory;
use Faker\Generator as Faker;

class FactoryTest extends TestCase
{
    /** @test */
    function it_generates_a_new_model_instance()
    {
        $factory = new ExampleFactory();

        $model = $factory->createModel([]);

        $this->assertInstanceOf(BaseModel::class, $model);
    }

    /** @test */
    function it_generates_a_new_model_with_default_attributes()
    {
        $factory = new ExampleFactory();

        $model = $factory->createModel();

        $this->assertSame('Default Value', $model->default_attribute);
    }

    /** @test */
    function it_generates_a_new_model_with_custom_attributes()
    {
        $factory = new ExampleFactory();

        $model = $factory->createModel([
            'custom_attribute' => 'Custom Value'
        ]);

        $this->assertSame('Custom Value', $model->custom_attribute);
    }
    
    /** @test */
    function it_uses_faker_to_generate_models_with_random_data()
    {
        $factory = new ExampleFactory();

        $model = $factory->createModel();

        $this->assertInstanceOf(Faker::class, $model->faker);
    }

    /** @test */
    function it_can_generate_several_models_at_once()
    {
        $factory = new ExampleFactory();

        $models = $factory->createModels(3);

        $this->assertCount(3, $models);
        $this->assertInstanceOf(BaseModel::class, $models[0]);
        $this->assertInstanceOf(BaseModel::class, $models[1]);
        $this->assertInstanceOf(BaseModel::class, $models[2]);
    }
}

class ExampleFactory extends Factory
{
    protected function getAttributes(Faker $faker): array
    {
        return [
            'default_attribute' => 'Default Value',
            'faker' => $faker,
        ];
    }

    protected function makeModel(): BaseModel
    {
        return new ExampleModel;
    }
}