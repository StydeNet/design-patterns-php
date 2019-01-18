<?php

namespace Styde\Observers;

use Styde\Mail\Mailer;
use SplObserver, SplSubject;

class SendWelcomeEmail implements SplObserver
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function update(SplSubject $subject)
    {
        $this->mailer->send($subject->user->email, 'Welcome', "Hello {$subject->user->name}, welcome to Styde!");
    }
}
