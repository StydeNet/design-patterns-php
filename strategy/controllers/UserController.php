<?php

class UserController
{

    public function create()
    {
        (new WelcomeNotification())->notify();
    }
}
