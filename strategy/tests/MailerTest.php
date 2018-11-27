<?php

namespace Styde\Strategy\Tests;

use Styde\Strategy\Mailer;
use StephaneCoinon\Mailtrap\Inbox;
use StephaneCoinon\Mailtrap\Model;
use StephaneCoinon\Mailtrap\Client;

class MailerTest extends TestCase
{
    /** @test */
    function it_sends_emails_using_smtp()
    {
        // - Given / Setup / Arrange

        // Instantiate Mailtrap API client
        $client = new Client('4d65125c115709da5403fcd2d5a2e0ef');

        // Boot API models
        Model::boot($client);

        // Fetch an inbox by its id
        $inbox = Inbox::find(500267);

        // - When / Act

        $mailer = new Mailer;
        $mailer->setSender('admin@styde.net');

        $sent = $mailer->send('duilio@styde.net', 'An example message', 'The content of the message');

        // - Then / Assert

        $this->assertTrue($sent);

        // Get the last (newest) message in an inbox
        $newestMessage = $inbox->lastMessage();

        $this->assertNotNull($newestMessage);
        $this->assertSame(['duilio@styde.net'], $newestMessage->recipientEmails());
        $this->assertSame('An example message', $newestMessage->subject());
        $this->assertContains('The content of the message', $newestMessage->body());
    }
}





