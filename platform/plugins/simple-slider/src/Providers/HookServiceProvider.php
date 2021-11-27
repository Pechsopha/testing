<?php

namespace Botble\SimpleSlider\Providers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Shortcode\Compilers\Shortcode;
use Botble\SimpleSlider\Repositories\Interfaces\SimpleSliderInterface;
use Illuminate\Support\ServiceProvider;
use Theme;

class HookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (setting('simple_slider_using_assets', true) && defined('THEME_OPTIONS_MODULE_SCREEN_NAME')) {
            Theme::asset()
                ->container('footer')
                ->add('owl.carousel', 'vendor/core/plugins/simple-slider/libraries/owl-carousel/owl.carousel.css')
                ->add('simple-slider-css', 'vendor/core/plugins/simple-slider/css/simple-slider.css')
                ->add('carousel', 'vendor/core/plugins/simple-slider/libraries/owl-carousel/owl.carousel.js', ['jquery'])
                ->add('simple-slider-js', 'vendor/core/plugins/simple-slider/js/simple-slider.js', ['jquery']);
        }

        if (function_exists('shortcode')) {
            add_shortcode('simple-slider', __('Simple Slider'), __('Add a simple slider'), [$this, 'render']);
        }

        add_filter(BASE_FILTER_AFTER_SETTING_CONTENT, [$this, 'addSettings'], 301, 1);
    }

    /**
     * @param Shortcode $shortcode
     * @return null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function render($shortcode)
    {
        $simple_slider = $this->app->make(SimpleSliderInterface::class)->getFirstBy([
            'key'    => $shortcode->key,
            'status' => BaseStatusEnum::PUBLISHED,
        ]);

        if (empty($simple_slider)) {
            return null;
        }

        return view('plugins/simple-slider::sliders', ['sliders' => $simple_slider->sliderItems]);
    }

    /**
     * @param null $data
     * @return string
     * @throws \Throwable
     */
    public function addSettings($data = null)
    {
        return $data . view('plugins/simple-slider::setting')->render();
    }
}
