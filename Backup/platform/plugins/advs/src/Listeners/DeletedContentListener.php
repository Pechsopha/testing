<?php

namespace Botble\Advs\Listeners;

use Botble\Base\Events\DeletedContentEvent;
use Exception;
use Advs;

class DeletedContentListener
{

    /**
     * Handle the event.
     *
     * @param DeletedContentEvent $event
     * @return void
     */
    public function handle(DeletedContentEvent $event)
    {
        try {
            Advs::deleteAdvs($event->data);
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}