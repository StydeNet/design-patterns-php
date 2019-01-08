<?php

namespace Styde\Mail;

class ArrayTransport extends Transport
{
    protected $sent = [];

    public function send($recipient, $subject, $body, $sender)
    {
        $this->sent[] = compact('recipient', 'subject', 'body');

        return true;
    }

    public function sent()
    {
        return $this->sent;
    }
}