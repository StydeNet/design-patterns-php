<?php

namespace YouTube;

use BadMethodCallException;

class Client
{
    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @param string $clientSecret
     */
    public function setClientSecret(string $clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    public function connect()
    {
        if ($this->clientId == '' || $this->clientSecret == '') {
            throw new BadMethodCallException('The credentials have not been set');
        }

        // Connect to server...
    }
}
