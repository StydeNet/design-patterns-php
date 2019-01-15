<?php

namespace Styde\Tests;

use Styde\Registration;

class RegistrationTest extends TestCase
{
    /** @test */
    function user_registration()
    {
        $logger = $this->loggerFake('test-log-registration.txt');

        $mailer = $this->mailerFake();

        $registration = new Registration($logger, $mailer);

        $result = $registration->create([
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',
            'password' => 'laravel',
        ]);

        $this->assertTrue($result);

        // $this->assertDatabaseHas('users', [...])

        $logger->assertFileEquals('User Duilio <duilio@styde.net> was created');

        $mailer->assertSentTimes(1)
            ->assertSentTo('duilio@styde.net')
            ->assertSubjectEquals('Welcome')
            ->assertBodyEquals('Hello Duilio, welcome to Styde!');
    }
}





