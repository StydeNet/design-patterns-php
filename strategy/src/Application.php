<?php

namespace Styde\Strategy;

class Application
{
    protected static $instance;

    protected $config;
    protected $transportManager;

    protected $bootstrappers = [
        LoadConfiguration::class
    ];

    public static function getInstance()
    {
        if (static::$instance == null) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    private function __construct()
    {

    }

    public function bootstrap()
    {
        foreach ($this->bootstrappers as $bootstrapper) {
            (new $bootstrapper)->bootstrap($this);
        }
    }

    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function getTransportManager()
    {
        if ($this->transportManager == null) {
            $this->transportManager = new TransportManager($this->getConfig());
        }

        return $this->transportManager;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getMailer($transport = null)
    {
        return new Mailer($this->getTransportManager()->driver(
            $transport ?: $this->getConfig()->get('mail.default')
        ));
    }
}
