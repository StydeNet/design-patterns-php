<?php

namespace Styde\Strategy\Tests;

use Styde\Strategy\Mailer;
use StephaneCoinon\Mailtrap\Model;
use StephaneCoinon\Mailtrap\Inbox;
use StephaneCoinon\Mailtrap\Client;

class MailerTest extends TestCase
{
    /** @test */
    function stores_sent_emails_in_memory()
    {
        $mailer = new Mailer('array');
        $mailer->setSender('admin@styde.net');
        $mailer->send('duilio@styde.net', 'An example message', 'The content of the message');

        $sent = $mailer->sent();

        $this->assertCount(1, $sent);
        $this->assertSame('duilio@styde.net', $sent[0]['recipient']);
        $this->assertSame('An example message', $sent[0]['subject']);
        $this->assertSame('The content of the message', $sent[0]['body']);
    }
    
    /** @test */
    function stores_sent_emails_in_a_log_file()
    {
        $filename = __DIR__.'/../storage/test.txt';
        @unlink($filename);

        $mailer = new Mailer('file');

        $mailer->setFilename($filename);
        $mailer->setSender('admin@styde.net');
        $mailer->send('duilio@styde.net', 'An example message', 'The content of the message');

        $logContent = file_get_contents($filename);

        $this->assertContains('Recipient: duilio@styde.net', $logContent);
        $this->assertContains('Subject: An example message', $logContent);
        $this->assertContains('Body: The content of the message', $logContent);
    }

    /**
     * @test
     * @group integration
     */
    function it_sends_and_email_using_smtp()
    {
        // Instantiate Mailtrap API client
        $client = new Client('ac41dc9995ade5e5ea7825c71cc0a6d6');

        // Boot API models
        Model::boot($client);

        $inbox = Inbox::find(61447);

        $inbox->empty();

        $mailer = new Mailer('smtp');
        $mailer->setSender('admin@styde.net');

        $sent = $mailer->send('duilio@styde.net', 'An example message', 'The content of the message');

        $this->assertTrue($sent);

        $message = $inbox->lastMessage();

        $this->assertSame(['duilio@styde.net'], $message->recipientEmails());
        $this->assertSame('An example message', $message->subject());
        $this->assertContains('The content of the message', $message->body());
    }
}
