<?php

namespace Styde\Factories;

use Styde\Models\BaseModel;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

abstract class Factory
{
    protected $faker;

    public function __construct()
    {
        $this->faker = FakerFactory::create(); // Suggestion: use dependency injection
    }

    public function createModel(array $attributes = []): BaseModel
    {
        $model = $this->makeModel();

//        $this->beforeCreatingModel($model);

        $model->unguard()
            ->fill($this->mergeAttributes($attributes))
            ->reguard()
            ->save();

//        $this->afterCreatingModel($model);

        return $model;
    }

    public function createModels($amount)
    {
        return array_map(function () {
            return $this->createModel();
        }, range(1, $amount));
    }

    abstract protected function makeModel(): BaseModel;

    protected function getAttributes(Faker $faker): array
    {
        return [];
    }

    protected function mergeAttributes(array $attributes): array
    {
        return array_merge($this->getAttributes($this->faker), $attributes);
    }
}