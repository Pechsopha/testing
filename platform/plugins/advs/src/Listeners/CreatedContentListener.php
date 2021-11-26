<?php

namespace Botble\Advs\Listeners;

use Botble\Base\Events\CreatedContentEvent;
use Exception;
use Advs;

class CreatedContentListener
{

    /**
     * Handle the event.
     *
     * @param CreatedContentEvent $event
     * @return void
     */
    public function handle(CreatedContentEvent $event)
    {
        try {
            Advs::saveAdvs($event->request, $event->data);
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}