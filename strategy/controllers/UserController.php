<?php

use Styde\Strategy\Application;

class UserController
{
    public function create()
    {
        new Registrar();
    }
}
