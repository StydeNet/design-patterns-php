<?php

namespace Styde\Strategy;

use InvalidArgumentException;

class TransportManager extends Manager
{
    protected static $instance;

    protected $defaultDriver = 'array';

    protected $config;

    public static function getInstance()
    {
        if (static::$instance == null) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public function __construct()
    {
        $this->config = Config::getInstance();
    }

    protected function createArrayDriver()
    {
        return new ArrayTransport;
    }

    protected function createFileDriver()
    {
        return new FileTransport(__DIR__.'/../storage/test.txt');
    }

    protected function createSmtpDriver()
    {
        return new SmtpTransport(
            $this->config['mail.smtp.host'],
            $this->config['mail.smtp.username'],
            $this->config['mail.smtp.password'],
            $this->config['mail.smtp.port']
        );
    }
}
