<?php

namespace Botble\Advs\Listeners;

use Botble\Base\Events\UpdatedContentEvent;
use Exception;
use Advs;

class UpdatedContentListener
{

    /**
     * Handle the event.
     *
     * @param UpdatedContentEvent $event
     * @return void
     */
    public function handle(UpdatedContentEvent $event)
    {
        try {
            Advs::saveAdvs($event->request, $event->data);
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}