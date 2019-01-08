<?php

namespace Styde\Tests;

use StephaneCoinon\Mailtrap\{Client, Inbox, Model};
use Styde\Mail\{ArrayTransport, FileTransport, Mailer, SmtpTransport};

class MailerTest extends TestCase
{
    /** @test */
    function it_stores_the_sent_emails_in_an_array()
    {
        $mailer = new Mailer($transport = new ArrayTransport);
        $mailer->setSender('admin@styde.net');

        $mailer->send('duilio@styde.net', 'An example message', 'The content of the message');

        $sent = $transport->sent();

        $this->assertCount(1, $sent);
        $this->assertSame('duilio@styde.net', $sent[0]['recipient']);
        $this->assertSame('An example message', $sent[0]['subject']);
        $this->assertSame('The content of the message', $sent[0]['body']);
    }
    
    /** @test */
    function it_stores_the_sent_emails_in_a_log_file()
    {
        $filename = __DIR__.'/../storage/mailer-test.txt';
        @unlink($filename);

        $mailer = new Mailer(new FileTransport($filename));
        $mailer->setSender('admin@styde.net');

        $mailer->send('duilio@styde.net', 'An example message', 'The content of the message');

        $content = file_get_contents($filename);

        $this->assertContains('Recipient: duilio@styde.net', $content);
        $this->assertContains('Subject: An example message', $content);
        $this->assertContains('Body: The content of the message', $content);
    }
    
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

        // Delete all messages from the inbox
        $inbox->empty();

        // - When / Act

        $mailer = new Mailer(new SmtpTransport('smtp.mailtrap.io', '8635d2f35a1bed', '200421505463ed', '25'));
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
