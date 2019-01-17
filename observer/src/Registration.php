<?php

namespace Styde;

use Styde\Observers\NotifiesObservers;

class Registration
{
    use NotifiesObservers;

    protected $user;

    public function create(array $data)
    {
        $this->user = User::create($data);

        $this->notify();

        return true;
    }

    public function getUser()
    {
        return $this->user;
    }
}
