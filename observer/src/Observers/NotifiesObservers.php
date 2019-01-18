<?php


namespace Styde\Observers;

use SplObserver;
use SplObjectStorage;

trait NotifiesObservers
{
    protected $observers;

    public function attach(SplObserver $observer)
    {
        $this->initializeObservers();

        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->initializeObservers();

        $this->observers->detach($observer);
    }

    public function notify()
    {
        $this->initializeObservers();

        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    protected function initializeObservers()
    {
        if ($this->observers == null) {
            $this->observers = new SplObjectStorage;
        }
    }
}
