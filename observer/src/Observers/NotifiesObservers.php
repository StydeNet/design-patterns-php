<?php


namespace Styde\Observers;


trait NotifiesObservers
{
    protected $observers = [];

    public function attach(Observer ...$observers)
    {
        $this->observers = array_merge($this->observers, $observers);
    }

    protected function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->handle($this);
        }
    }
}
