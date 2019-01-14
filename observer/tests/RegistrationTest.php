<?php

namespace Styde\Tests;

use Styde\Registration;

class RegistrationTest extends TestCase
{
    /** @test */
    function user_registration()
    {
        $registration = new Registration();

        $result = $registration->create([
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',
            'password' => 'laravel',
        ]);

        $this->assertTrue($result);

        // $this->assertDatabaseHas('users', [...])
    }
}