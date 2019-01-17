<?php

namespace Styde\Observers;

use Styde\Log\Logger;

class LogUserRegistration implements Observer
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function handle($subject)
    {
        $user = $subject->getUser();

        $this->logger->log("User {$user->name} <{$user->email}> was created");
    }
}
