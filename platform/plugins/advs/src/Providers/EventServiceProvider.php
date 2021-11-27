<?php

namespace Botble\Advs\Providers;

use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Theme\Events\RenderingSiteMapEvent;
use Botble\Base\Events\UpdatedContentEvent;
// use Botble\Advs\Listeners\CreatedContentListener;
// use Botble\Advs\Listeners\DeletedContentListener;
// use Botble\Advs\Listeners\RenderingSiteMapListener;
// use Botble\Advs\Listeners\UpdatedContentListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RenderingSiteMapEvent::class => [
            RenderingSiteMapListener::class,
        ],
        UpdatedContentEvent::class   => [
            UpdatedContentListener::class,
        ],
        CreatedContentEvent::class   => [
            CreatedContentListener::class,
        ],
        DeletedContentEvent::class   => [
            DeletedContentListener::class,
        ],
    ];
}