<?php

class ContactController
{
    protected $manager;

    public function __construct(TransportManager $manager)
    {
        $this->manager = $manager;
    }

    public function send()
    {
        $mailer = new Mailer($this->manager->driver());
        $mailer->setSender('admin@styde.net');

        $sent = $mailer->send('duilio@styde.net', 'An example message', 'The content of the message');
    }
}
