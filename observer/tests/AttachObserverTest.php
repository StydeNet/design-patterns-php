<?php

namespace Styde\Tests;

use SplObserver;
use Styde\Registration;
use Styde\Observers\SendWelcomeEmail;
use Styde\Observers\LogUserRegistration;

class AttachObserverTest extends TestCase
{
    /** @test */
    function it_can_detach_observer()
    {
        $logger = $this->loggerFake('test-log-registration.txt');

        $mailer = $this->mailerFake();

        $registration = new Registration;
        $mail = new class ($logger) extends LogUserRegistration implements SplObserver{};
        $log = new class ($mailer) extends SendWelcomeEmail implements SplObserver{};
        $registration->attach($log);
        $registration->attach($mail);

        $registration->detach($mail);

        $result = $registration->create([
            'name' => 'Duilio',
            'email' => 'duilio@styde.net',
            'password' => 'laravel',
        ]);

        $this->assertTrue($result);

        // $this->assertDatabaseHas('users', [...])

        $logger->assertFileEquals('User Duilio <duilio@styde.net> was created');

        $mailer->assertSentTimes(0);
    }
}





