<?php

namespace Botble\Facebook\Providers;

use Illuminate\Support\ServiceProvider;
use Theme;

class HookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (defined('THEME_FRONT_FOOTER')) {
            if (setting('facebook_show_chat_box', true)) {
                add_filter(THEME_FRONT_FOOTER, [$this, 'registerFacebookChat'], 1921);
            }
        }

        if (setting('facebook_access_token') &&
            setting('facebook_auto_post_to_fan_page', 0) &&
            config('plugins.facebook.general.use_token')
        ) {
            add_action(BASE_ACTION_META_BOXES, [$this, 'addFacebookBox'], 134, 2);
        }

        if (setting('facebook_use_comments', true)) {
            add_filter(BASE_FILTER_PUBLIC_COMMENT_AREA, [$this, 'addFacebookComments'], 137, 0);
        }
    }

    /**
     * @param string $html
     * @return string
     *
     * @throws \Throwable
     */
    public function registerFacebookScripts(string $html)
    {
        return $html . view('plugins/facebook::scripts')->render();
    }

    /**
     * @param string $html
     * @return string
     *
     * @throws \Throwable
     */
    public function registerFacebookChat(string $html)
    {
        return $html . view('plugins/facebook::chat')->render();
    }

    /**
     * @param string $reference
     */
    public function addFacebookBox(string $reference)
    {
        $args = func_get_args();
        if (count($args) == 2 || (count($args) == 3 && empty($args[2]))) {
            if (in_array($reference, config('plugins.facebook.general.screen_supported_auto_post', []))) {
                add_meta_box(
                    'facebook_box_wrap',
                    trans('plugins/facebook::facebook.facebook_box_title'),
                    [$this, 'facebookMetaField'],
                    $reference,
                    'top',
                    'default'
                );
            }
        }
    }

    /**
     *
     * @throws \Throwable
     * @return string
     */
    public function facebookMetaField()
    {
        return view('plugins/facebook::meta-box')->render();
    }

    /**
     *
     * @throws \Throwable
     * @return string
     */
    public function addFacebookComments()
    {
        Theme::asset()->usePath(false)->add('facebook-css', asset('vendor/core/plugins/facebook/css/facebook.css'));

        return view('plugins/facebook::comments')->render();
    }
}
