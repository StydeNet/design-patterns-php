<?php

namespace Styde\Log;

class Logger
{
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }
    
    public function log($message)
    {
        return file_put_contents($this->filename, $message, FILE_APPEND);
    }
}
