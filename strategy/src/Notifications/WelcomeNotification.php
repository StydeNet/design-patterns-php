<?php

namespace Styde\Strategy\Notifications;

class WelcomeNotification
{
    public function notify()
    {
        $mailer = App::mailer();

        $mailer->setSender('admin@styde.net');

        $sent = $mailer->send('duilio@styde.net', 'An example message', 'The content of the message');
    }
}
