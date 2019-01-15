<?php

namespace Styde\Tests;

use Styde\Log\Logger;

class LoggerTest extends TestCase
{
    /** @test */
    function it_stores_the_log_message_in_a_log_file()
    {
        $filename = storage_path('logger-test.txt');
        @unlink($filename);

        $logger = new Logger($filename);

        $logger->log('This is a test message');

        $this->assertSame('This is a test message', file_get_contents($filename));
    }
}
