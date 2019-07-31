<?php

namespace Styde\Strategy\Tests;

use ReflectionClass;
use Styde\Strategy\Config;
use Styde\Strategy\Mailer;
use InvalidArgumentException;
use StephaneCoinon\Mailtrap\Inbox;
use StephaneCoinon\Mailtrap\Model;
use StephaneCoinon\Mailtrap\Client;
use Styde\Strategy\TransportManager;
use Styde\Strategy\LoadConfiguration;

class MailerTest extends TestCase
{
    protected $manager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->manager = TransportManager::getInstance();
    }

    /** @test */
    function it_stores_the_sent_emails_in_an_array()
    {
        $mailer = new Mailer($transport = $this->manager->driver('array'));
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
        $transport = $this->manager->driver('file');

        @unlink($transport->getFilename());

        $mailer = new Mailer($transport);
        $mailer->setSender('admin@styde.net');

        $mailer->send('duilio@styde.net', 'An example message', 'The content of the message');

        $content = file_get_contents($transport->getFilename());

        $this->assertStringContainsString('Recipient: duilio@styde.net', $content);
        $this->assertStringContainsString('Subject: An example message', $content);
        $this->assertStringContainsString('Body: The content of the message', $content);
    }

    /** @test */
    function it_sends_emails_using_smtp()
    {
        // - Given / Setup / Arrange
        $inbox = $this->bootMailtrap();

        $mailer = new Mailer($this->manager->driver('smtp'));
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
            $this->manager->driver('invalid');
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





