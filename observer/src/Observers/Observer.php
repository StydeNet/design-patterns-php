<?php

namespace Styde\Observers;

interface Observer
{
    public function handle($subject);
}