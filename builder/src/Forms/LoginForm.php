<?php

namespace Styde\Forms;

use Styde\Html\{Button, Div, Form, Input, Label, TextElement};

// BulmaForm

// BootstrapRegisterForm extends BootstrapForm
// BootstrapLoginForm extends BootstrapForm

// BulmaRegisterForm extends BulmaForm
// BulmaLoginForm extends BulmaForm

class LoginForm
{
    protected $form;

    public function __construct()
    {
        $this->form = new Form(['action' => '/login', 'method' => 'POST']);
    }

    public function build()
    {
        $this->addHiddenInput('csrf_token', 'token_here');

        $this->addField('email', 'email', 'Email address', ['placeholder' => 'Email address', 'autofocus']);

        $this->addField('password', 'password', 'Password', ['placeholder' => 'Password']);

        $this->addCheckboxField('remember_me', 'Remember me', 'remember-me');

        $this->addButton('submit', 'Sign in');

        return $this->form;
    }

    protected function addInput($type, $name, array $attributes = [])
    {
        $emailInput = new Input($name, array_merge([
            'type' => $type, 'id' => $name, 'class' => 'form-control', 'required'
        ], $attributes));

        $this->form->add($emailInput);
    }

    protected function addCheckboxField($name, $text, $value = null)
    {
        $div = new Div(['class' => 'checkbox mb-3']);

        $checkbox = new Input($name, ['type' => 'checkbox', 'value' => $value]);

        $label = new Label;
        $label->add($checkbox);
        $label->add(new TextElement(' '.$text));

        $div->add($label);

        $this->form->add($div);
    }

    protected function addButton($type, $text)
    {
        $button = new Button(['class' => 'btn btn-lg btn-primary btn-block', 'type' => $type]);

        $button->add(new TextElement($text));

        $this->form->add($button);
    }

    protected function addHiddenInput($name, $value)
    {
        $this->addInput('hidden', $name, ['value' => $value]);
    }

    protected function addLabel($id, $text)
    {
        $emailLabel = new Label(['for' => $id, 'class' => 'sr-only']);

        $emailLabel->add(new TextElement($text));

        $this->form->add($emailLabel);
    }

    protected function addField($type, $name, $text, array $attributes = [])
    {
        $this->addLabel($name, $text);

        $this->addInput($type, $name, $attributes);
    }
}