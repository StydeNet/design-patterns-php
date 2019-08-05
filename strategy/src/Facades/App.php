<?php

namespace Styde\Strategy\Facades;

use Styde\Strategy\Application;

class App
{
    public static function mailer($driver = null)
    {
        return Application::getInstance()->getMailer($driver);
    }
}
