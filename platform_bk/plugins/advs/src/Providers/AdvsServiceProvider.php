<?php

namespace Botble\Advs\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
//use Botble\Gallery\Facades\GalleryFacade;
use Botble\Advs\Models\Advs;
//use Botble\Gallery\Models\GalleryMeta;
//use Botble\Gallery\Repositories\Caches\GalleryMetaCacheDecorator;
//use Botble\Gallery\Repositories\Eloquent\GalleryMetaRepository;
//use Botble\Gallery\Repositories\Interfaces\GalleryMetaInterface;
use Event;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Botble\Advs\Repositories\Caches\AdvsCacheDecorator;
use Botble\Advs\Repositories\Eloquent\AdvsRepository;
use Botble\Advs\Repositories\Interfaces\AdvsInterface;
use Language;
use SeoHelper;
use SlugHelper;

class AdvsServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(AdvsInterface::class, function () {
            return new AdvsCacheDecorator(
                new AdvsRepository(new Advs)
            );
        });



        Helper::autoload(__DIR__ . '/../../helpers');

        //AliasLoader::getInstance()->alias('Gallery', GalleryFacade::class);
    }

    public function boot()
    {
        $this->setNamespace('plugins/advs')
            ->loadAndPublishConfigurations(['general', 'permissions'])
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations()
            ->publishAssets();

        $this->app->register(HookServiceProvider::class);
        // $this->app->register(EventServiceProvider::class);

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-advs', // key of menu, it should unique
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/advs::advs.menu_name', // menu name, if you don't need translation, you can use the name in plain text
                'icon'        => 'fa fa-image',
                'url'         => route('advs.index'),
                'permissions' => ['advs.index'], // permission should same with route name, you can see that flag in Plugin.php
            ]);
        });
    }
}