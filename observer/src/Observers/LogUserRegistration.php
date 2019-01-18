<?php

namespace Styde\Observers;

use SplObserver, SplSubject;
use Styde\Log\Logger;

class LogUserRegistration implements SplObserver
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function update(SplSubject $subject)
    {
        $this->logger->log("User {$subject->user->name} <{$subject->user->email}> was created");
    }
}
