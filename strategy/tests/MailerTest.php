<?php

namespace Styde\Strategy\Tests;

use ReflectionClass;
use Styde\Strategy\Application;
use Styde\Strategy\Config;
use Styde\Strategy\Facades\App;
use Styde\Strategy\Mailer;
use InvalidArgumentException;
use StephaneCoinon\Mailtrap\Inbox;
use StephaneCoinon\Mailtrap\Model;
use StephaneCoinon\Mailtrap\Client;
use Styde\Strategy\SmtpTransport;
use Styde\Strategy\TransportManager;
use Styde\Strategy\LoadConfiguration;

class MailerTest extends TestCase
{
    /** @test */
    function gets_a_mailer_with_a_default_transport()
    {
        $this->assertInstanceOf(
            SmtpTransport::class,
            Application::getInstance()->getMailer()->getTransport()
        );
    }

    /** @test */
    function creates_only_one_instance_of_transport_manager()
    {
        $this->assertSame($this->app->getTransportManager(), $this->app->getTransportManager());
    }

    /** @test */
    function it_stores_the_sent_emails_in_an_array()
    {
        $mailer = App::mailer('array');
        $mailer->setSender('admin@styde.net');

        $mailer->send('duilio@styde.net', 'An example message', 'The content of the message');

        $sent = $mailer->getTransport()->sent();

        $this->assertCount(1, $sent);
        $this->assertSame('duilio@styde.net', $sent[0]['recipient']);
        $this->assertSame('An example message', $sent[0]['subject']);
        $this->assertSame('The content of the message', $sent[0]['body']);
    }

    /** @test */
    function it_stores_the_sent_emails_in_a_log_file()
    {
        $mailer = App::mailer('file');
        $mailer->setSender('admin@styde.net');

        @unlink($mailer->getTransport()->getFilename());

        $mailer->send('duilio@styde.net', 'An example message', 'The content of the message');

        $content = file_get_contents($mailer->getTransport()->getFilename());

        $this->assertStringContainsString('Recipient: duilio@styde.net', $content);
        $this->assertStringContainsString('Subject: An example message', $content);
        $this->assertStringContainsString('Body: The content of the message', $content);
    }

    /** @test */
    function it_sends_emails_using_smtp()
    {
//        $this->markTestSkipped();

        // - Given / Setup / Arrange
        $inbox = $this->bootMailtrap();

        $mailer = App::mailer('smtp');
        $mailer->setSender('admin@styde.net');

        // - When / Act
        $sent = $mailer->send('duilio@styde.net', 'An example message', 'The content of the message');

        // - Then / Assert
        $this->assertTrue($sent);

        $newestMessage = $inbox->lastMessage();
        $this->assertNotNull($newestMessage);
        $this->assertSame(['duilio@styde.net'], $newestMessage->recipientEmails());
        $this->assertSame('An example message', $newestMessage->subject());
        $this->assertStringContainsString('The content of the message', $newestMessage->body());
    }

    /** @test */
    function it_throws_an_invalid_argument_exception_if_the_transport_type_does_not_exist()
    {
//        $this->expectException(InvalidArgumentException::class);
//        $this->expectExceptionMessage('Driver [invalid] not found.');

        try {
            $this->app->getTransportManager()->driver('invalid');
        } catch (InvalidArgumentException $e) {
            $this->assertSame('Driver [invalid] not found.', $e->getMessage());

            //...

            return;
        }

        $this->fail('The expected InvalidArgumentException was not thrown.');
    }

    /**
     * @return null|static
     */
    protected function bootMailtrap()
    {
// Instantiate Mailtrap API client
        $client = new Client('4d65125c115709da5403fcd2d5a2e0ef');

        // Boot API models
        Model::boot($client);

        // Fetch an inbox by its id
        $inbox = Inbox::find(500267);

        // Delete all messages from the inbox
        $inbox->empty();
        return $inbox;
    }
}





