<?php

namespace Styde\Tests;

use Styde\Models\BaseModel;

class ExampleModel extends BaseModel
{
    protected $fillable = ['name', 'email'];
}
