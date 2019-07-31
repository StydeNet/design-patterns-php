<?php

namespace Styde\Strategy;

class LoadConfiguration
{
    public function bootstrap(Application $app)
    {
        $config = Config::getInstance();

        $config->set('mail', [
            'smtp' => [
                'host' => 'smtp.mailtrap.io',
                'username' => '8635d2f35a1bed',
                'password' => '200421505463ed',
                'port' => '25'
            ]
        ]);
    }
}
