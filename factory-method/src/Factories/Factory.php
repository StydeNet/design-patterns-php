<?php

namespace Styde\Factories;

use Styde\Models\BaseModel;

abstract class Factory
{
    public function createModel(array $attributes)
    {
        $model = $this->makeModel()
            ->unguard()
            ->setAttributes($attributes)
            ->reguard()
            ->save();

        return $model;
    }

    abstract protected function makeModel(): BaseModel;
}