<?php

namespace Styde\Observers;

use Styde\Mail\Mailer;

class SendWelcomeEmail implements Observer
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle($subject)
    {
        $user = $subject->getUser();

        $this->mailer->send('duilio@styde.net', 'Welcome', "Hello {$user->name}, welcome to Styde!");
    }
}
