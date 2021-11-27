<?php

namespace Botble\Facebook\Providers;

use Illuminate\Routing\Events\RouteMatched;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Facebook\Widgets\FacebookWidget;
use Botble\Setting\Supports\SettingStore;
use Event;
use Illuminate\Support\ServiceProvider;
use Botble\Base\Supports\Helper;

class FacebookServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        $this->setNamespace('plugins/facebook')
            ->loadAndPublishConfigurations(['general', 'permissions'])
            ->loadAndPublishTranslations()
            ->loadRoutes(['web'])
            ->loadAndPublishViews()
            ->publishAssets();

        $config = $this->app->make('config');
        $setting = $this->app->make(SettingStore::class);

        if ($setting->get('facebook_enable')) {
            $this->app->register(HookServiceProvider::class);
            $this->app->register(EventServiceProvider::class);
        }

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-facebook',
                'priority'    => 3,
                'parent_id'   => 'cms-core-settings',
                'name'        => __('Facebook'),
                'icon'        => null,
                'url'         => route('facebook.settings'),
                'permissions' => ['facebook.settings'],
            ]);
        });

        $screensSupportConfigKey = 'plugins.facebook.general.screen_supported_auto_post';

        if (defined('POST_MODULE_SCREEN_NAME')) {
            $config->set($screensSupportConfigKey,
                array_merge($config->get($screensSupportConfigKey, []), [POST_MODULE_SCREEN_NAME]));
        }

        if (defined('PRODUCT_MODULE_SCREEN_NAME')) {
            $config->set($screensSupportConfigKey,
                array_merge($config->get($screensSupportConfigKey, []), [PRODUCT_MODULE_SCREEN_NAME]));
        }

        if (defined('WIDGET_MANAGER_MODULE_SCREEN_NAME')) {
            $this->app->booted(function () {
                register_widget(FacebookWidget::class);
            });
        }

        $config->set([
            'services.facebook' => [
                'app_id'                => $setting->get('facebook_app_id', config('plugins.facebook.general.app_id')),
                'app_secret'            => $setting->get('facebook_app_secret', config('plugins.facebook.general.app_secret')),
                'default_graph_version' => 'v2.12',
                'default_scope'         => [],
                'default_redirect_uri'  => '/auth/callback/facebook',
            ],
        ]);
    }
}
