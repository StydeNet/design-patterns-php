<?php

namespace Styde\Strategy;

class Application
{
    protected static $instance;

    protected $bootstrappers = [
        LoadConfiguration::class
    ];

    protected $transportManager;

    public static function getInstance()
    {
        if (static::$instance == null) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public function bootstrap()
    {
        foreach ($this->bootstrappers as $bootstrapper) {
            (new $bootstrapper)->bootstrap($this);
        }

        return $this;
    }

    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getTransportManager()
    {
        if ($this->transportManager == null) {
            $this->transportManager = new TransportManager($this->getConfig());
        }

        return $this->transportManager;
    }

    public function getMailer($driver = null)
    {
        return new Mailer($this->getTransportManager()->driver(
            $driver ?: $this->getConfig()->get('mail.driver'))
        );
    }
}
