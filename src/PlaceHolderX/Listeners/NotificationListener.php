<?php

namespace PlaceHolderX\Listeners;

use PlaceHolderX\Events\Notification\NotificationEvent;

interface NotificationListener
{

    /**
     * @param NotificationEvent $event
     */
    public function notify(NotificationEvent $event);

}