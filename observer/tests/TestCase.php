<?php

namespace Styde\Tests;
use Styde\Testing\LoggerFake;
use Styde\Testing\MailerFake;
use Styde\Mail\ArrayTransport;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function loggerFake($filename)
    {
        $filename = storage_path($filename);
        @unlink($filename);

        return new LoggerFake($filename);
    }

    protected function mailerFake()
    {
        $mailer = new MailerFake($transport = new ArrayTransport);
        $mailer->setSender('admin@styde.net');
        return $mailer;
    }
}