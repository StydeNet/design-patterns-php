<?php

namespace Styde\Mail;

abstract class Transport
{
    abstract public function send($recipient, $subject, $body, $sender);
}