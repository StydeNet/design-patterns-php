<?php

namespace Styde\Builders;

abstract class FormBuilder
{
    protected $form;

    public function getForm()
    {
        return $this->form;
    }

    public function addField($type, $name, $text, array $attributes = [])
    {

    }

    public function addCheckboxField($name, $text, $value = null)
    {

    }

    public function addCsrfInput()
    {

    }

    public function addLabel($id, $text)
    {

    }

    public function addInput($type, $name, array $attributes = [])
    {

    }

    public function addButton($type, $text)
    {

    }
}
