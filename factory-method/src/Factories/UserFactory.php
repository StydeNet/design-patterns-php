<?php

namespace Styde\Factories;

use Styde\Models\BaseModel;
use Styde\Models\User;

class UserFactory extends Factory
{
    protected function makeModel(): BaseModel
    {
        return new User;
    }
}