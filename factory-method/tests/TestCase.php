<?php

namespace Styde\Tests;

use Styde\Models\User;
use Styde\Factories\UserFactory;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function createUser(array $attributes): User
    {
        $factory = new UserFactory;

        return $factory->createModel($attributes);
    }
}
