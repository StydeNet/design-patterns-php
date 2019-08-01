<?php

namespace Styde\Strategy;

class Registrar
{
    public function register()
    {
        // Create a user

        $mailer = App::mailer('smtp');
        $mailer->setSender('admin@styde.net');

        $sent = $mailer->send('duilio@styde.net', 'An example message', 'The content of the message');
    }
}
