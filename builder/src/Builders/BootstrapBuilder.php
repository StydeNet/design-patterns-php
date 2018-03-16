<?php

namespace Styde\Builders;

use Styde\Html\{Button, Div, Form, Input, Label, TextElement};

class BootstrapBuilder
{
    protected $form;

    public function __construct()
    {
        $this->form = new Form(['action' => '/login', 'method' => 'POST']);
    }

    public function getForm()
    {
        return $this->form;
    }

    public function addField($type, $name, $text, array $attributes = [])
    {
        $this->addLabel($name, $text);

        $this->addInput($type, $name, $attributes);
    }

    public function addCheckboxField($name, $text, $value = null)
    {
        $div = new Div(['class' => 'checkbox mb-3']);

        $checkbox = new Input($name, ['type' => 'checkbox', 'value' => $value]);

        $label = new Label;
        $label->add($checkbox);
        $label->add(new TextElement(' '.$text));

        $div->add($label);

        $this->form->add($div);
    }

    public function addCsrfInput()
    {
        $csrfInput = new Input('csrf_token', ['type' => 'hidden', 'name' => 'csrf_token', 'value' => 'token_here']);

        $this->form->add($csrfInput);
    }

    public function addLabel($id, $text)
    {
        $emailLabel = new Label(['for' => $id, 'class' => 'sr-only']);

        $emailLabel->add(new TextElement($text));

        $this->form->add($emailLabel);
    }

    public function addInput($type, $name, array $attributes = [])
    {
        $emailInput = new Input($name, array_merge([
            'type' => $type, 'id' => $name, 'class' => 'form-control', 'required'
        ], $attributes));

        $this->form->add($emailInput);
    }

    public function addButton($type, $text)
    {
        $button = new Button(['class' => 'btn btn-lg btn-primary btn-block', 'type' => $type]);

        $button->add(new TextElement($text));

        $this->form->add($button);
    }
}
