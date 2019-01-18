<?php

namespace Styde;

use SplSubject;
use Styde\Observers\NotifiesObservers;

class Registration implements SplSubject
{
    use NotifiesObservers;

    public $user;

    public function create(array $data)
    {
        $this->user = User::create($data);

        $this->notify();

        return true;
    }

}
