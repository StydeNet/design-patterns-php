<?php

namespace Styde\Forms;

class LoginForm
{
    protected $builder;

    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    public function build()
    {
        $this->builder->addCsrfInput();

        $this->builder->addField('email', 'email', 'Email address', ['placeholder' => 'Email address', 'autofocus']);

        $this->builder->addField('password', 'password', 'Password', ['placeholder' => 'Password']);

        $this->builder->addCheckboxField('remember_me', 'Remember me', 'remember-me');

        $this->builder->addButton('submit', 'Sign in');

        return $this->builder->getForm();
    }
}
