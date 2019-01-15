<?php

namespace Styde\Testing;

use Styde\Mail\Mailer;
use PHPUnit\Framework\Assert as PHPUnit;

class MailerFake extends Mailer
{
    public function assertSentTimes($total)
    {
        $sent = $this->transport->sent();

        PHPUnit::assertCount($total, $sent);

        return $this;
    }

    public function assertSentTo($mail)
    {
        $sent = $this->transport->sent();

        PHPUnit::assertSame($mail, $sent[0]['recipient']);

        return $this;
    }

    public function assertSubjectEquals($subject)
    {
        $sent = $this->transport->sent();

        PHPUnit::assertSame($subject, $sent[0]['subject']);

        return $this;
    }

    public function assertBodyEquals($body)
    {
        $sent = $this->transport->sent();

        PHPUnit::assertSame($body, $sent[0]['body']);

        return $this;
    }
}