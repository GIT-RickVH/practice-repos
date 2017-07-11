<?php

namespace PlaceHolderX\Observers;

use PlaceHolderX\Events\Notification\NotificationEvent;
use PlaceHolderX\Listeners\NotificationListener;

class NotificationObserver
{
    /**
     * @var NotificationListener[]
     */
    private $listeners;

    /**
     * NotificationObserver constructor.
     */
    public function __construct()
    {
        $this->listeners = [];
    }

    /**
     * @param NotificationListener $listener
     * @return $this
     */
    public function addListener(NotificationListener $listener)
    {
        $this->listeners[] = $listener;
        return $this;
    }

    /**
     * @param NotificationEvent $event
     */
    public function dispatch(NotificationEvent $event)
    {
        foreach ($this->listeners as $listener) {
            $listener->notify($event);
        }
    }

}