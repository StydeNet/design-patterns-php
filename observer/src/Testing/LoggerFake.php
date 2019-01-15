<?php

namespace Styde\Testing;

use Styde\Log\Logger;
use PHPUnit\Framework\Assert as PHPUnit;

class LoggerFake extends Logger
{
    public function assertFileEquals($content)
    {
        PHPUnit::assertSame($content, file_get_contents($this->filename));
    }
}
