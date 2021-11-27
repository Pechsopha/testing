<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Botble\Blog\Models\Post;
use Illuminate\Http\Request;

register_sidebar([
    'id'          => 'footer_sidebar',
    'name'        => __('Footer sidebar'),
    'description' => __('This is footer sidebar section'),
]);

register_page_template([
    'homepage' => __('Homepage'),
]);

Menu::addMenuLocation('second-menu', __('Second menu'));

add_shortcode('google-map', 'Google map', 'Custom map', function ($shortCode) {
    return Theme::partial('short-codes.google-map', ['address' => $shortCode->content]);
});

add_shortcode('youtube-video', 'Youtube video', 'Add youtube video', function ($shortCode) {
    return Theme::partial('short-codes.video', ['url' => $shortCode->content]);
});

add_shortcode('featured-posts', 'Featured posts', 'Featured posts', function () {
    return Theme::partial('short-codes.featured-posts');
});

add_shortcode('category-posts', 'Category posts', 'Category posts', function () {
    return Theme::partial('short-codes.category-posts');
});

add_shortcode('all-galleries', 'All Galleries', 'All Galleries', function () {
    return Theme::partial('short-codes.all-galleries');
});

shortcode()->setAdminConfig('google-map', Theme::partial('short-codes.google-map-admin-config'));
shortcode()->setAdminConfig('youtube-video', Theme::partial('short-codes.youtube-admin-config'));

theme_option()
    ->setSection([
        'title'      => __('Banner Ads'),
        'desc'       => __('Change image'),
        'id'         => 'opt-text-subsection-banner-ads',
        'subsection' => true,
        'icon'       => 'fa fa-image',
        'fields'     => [
            [
                'id'         => 'banner-link',
                'type'       => 'text',
                'label'      => __('URL'),
                'attributes' => [
                    'name'    => 'banner-link',
                    'value'   => null,
                    'options' => [
                        'class'        => 'form-control',
                        'placeholder'  => __('Link to target URL'),
                        'data-counter' => 255,
                    ],
                ],
            ],
            [
                'id'         => 'banner-new-tab',
                'type'       => 'select',
                'label'      => __('Open in new tab?'),
                'attributes' => [
                    'name'    => 'banner-new-tab',
                    'data'    => [
                        0 => 'No',
                        1 => 'Yes',
                    ],
                    'value'   => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id'         => 'banner-ads',
                'type'       => 'mediaImage',
                'label'      => __('Image'),
                'attributes' => [
                    'name'  => 'banner-ads',
                    'value' => null,
                ],
            ],
        ],
    ])
    ->setField([
        'id'         => 'copyright',
        'section_id' => 'opt-text-subsection-general',
        'type'       => 'text',
        'label'      => __('Copyright'),
        'attributes' => [
            'name'    => 'copyright',
            'value'   => '© 2020 Botble Technologies. All right reserved. Designed by Nghia Minh',
            'options' => [
                'class'        => 'form-control',
                'placeholder'  => __('Change copyright'),
                'data-counter' => 120,
            ],
        ],
        'helper'     => __('Copyright on footer of site'),
    ]);

add_action(BASE_ACTION_META_BOXES, 'add_addition_fields_in_post_screen', 24, 2);

/**
 * @param string $context
 * @param $object
 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
 */
function add_addition_fields_in_post_screen($context, $object)
{
    if (is_plugin_active('blog') && get_class($object) == Post::class && $context == 'advanced') {
        add_meta_box('additional_post_fields', __('Addition Information'), 'post_additional_fields', get_class($object),
            $context,
            'default');
    }
}

/**
 * @return mixed
 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
 */
function post_additional_fields()
{
    $videoLink = null;
    $args = func_get_args();
    if (!empty($args[0])) {
        $videoLink = get_meta_data($args[0], 'video_link', true);
    }
    return Theme::partial('post-fields', compact('videoLink'));
}

add_action(BASE_ACTION_AFTER_CREATE_CONTENT, 'save_addition_post_fields', 230, 3);
add_action(BASE_ACTION_AFTER_UPDATE_CONTENT, 'save_addition_post_fields', 231, 3);

/**
 * @param $type
 * @param Request $request
 * @param $object
 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
 */
function save_addition_post_fields($type, $request, $object)
{
    if (is_plugin_active('blog') && get_class($object) == Post::class) {
        save_meta_data($object, 'video_link', $request->input('video_link'));
    }
}

add_action('init', function () {
    config(['filesystems.disks.public.root' => public_path('storage')]);
}, 124);

RvMedia::addSize('featured', 560, 380)->addSize('medium', 540, 360);
