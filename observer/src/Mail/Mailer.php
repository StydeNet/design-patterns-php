<?php

namespace Styde\Mail;

class Mailer
{
    protected $sender;

    protected $transport;
    
    public function __construct(Transport $transport)
    {
        $this->transport = $transport;
    }

    public function setSender($email)
    {
        $this->sender = $email;
    }

    public function send($recipient, $subject, $body)
    {
        return $this->transport->send($recipient, $subject, $body, $this->sender);
    }
}
