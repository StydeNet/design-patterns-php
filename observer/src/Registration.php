<?php

namespace Styde;

use Styde\Log\Logger;
use Styde\Mail\Mailer;

class Registration
{
    private $logger;
    private $mailer;

    public function __construct(Logger $logger, Mailer $mailer)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
    }

    public function create(array $data)
    {
        // $user = User::create($data);

        $this->logger->log("User {$data['name']} <{$data['email']}> was created");

        $this->mailer->send('duilio@styde.net', 'Welcome', "Hello {$data['name']}, welcome to Styde!");

        return true;
    }
}
