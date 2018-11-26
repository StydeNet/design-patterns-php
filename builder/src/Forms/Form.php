<?php

namespace Styde\Forms;

use Styde\Builders\FormBuilder;

abstract class Form
{
    /**
     * @var \Styde\Builders\FormBuilder
     */
    protected $builder;

    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    abstract public function createForm();
}