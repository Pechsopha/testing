<?php

use Botble\Advs\Repositories\Interfaces\AdvsInterface;

if (!function_exists('set_page_type')) {
    /**
     * @param int $limit
     * @return array
     */
    function set_page_type(int $page)
    {
        session(['pageType' => $page]);
        
    }
}

if (!function_exists('get_left_side_ads')) {
    /**
     * @param int $limit
     * @return array
     */
    function get_left_side_ads($data)
    {
        return $data->filter(function($value, $key) {
            return $value->position == 1 && ($value->page == session('pageType') || $value->page == 0);
        });
    }
}

if (!function_exists('get_right_side_ads')) {
    /**
     * @param int $limit
     * @return array
     */
    function get_right_side_ads($data)
    {
        return $data->filter(function($value, $key) {
            return $value->position == 2 && ($value->page == session('pageType') || $value->page == 0);
        });
    }
}

if (!function_exists('get_leaderboard_ads')) {
    /**
     * @param int $limit
     * @return array
     */
    function get_leaderboard_ads($data)
    {
        return $data->filter(function($value, $key) {
            return $value->position == 3 && ($value->page == session('pageType') || $value->page == 0);
        });
    }
}

if (!function_exists('get_below_faceboook_ads')) {
    /**
     * @param int $limit
     * @return array
     */
    function get_below_faceboook_ads($data)
    {
        return $data->filter(function($value, $key) {
            return $value->position == 4 && ($value->page == session('pageType') || $value->page == 0);
        });
    }
}

if (!function_exists('get_below_popular_post_ads')) {
    /**
     * @param int $limit
     * @return array
     */
    function get_below_popular_post_ads($data)
    {
        return $data->filter(function($value, $key) {
            return $value->position == 5 && ($value->page == session('pageType') || $value->page == 0);
        });
    }
}

if (!function_exists('get_standard_banner_ads')) {
    /**
     * @param int $limit
     * @return array
     */
    function get_standard_banner_ads($data, int $categoryId=0)
    {
        if ($categoryId != 0) {
            return $data->filter(function($value, $key) use($categoryId) {
                return $value->position == 6 && ($value->page == session('pageType') || $value->page == 0) && $value->category == $categoryId;
            });
        }
        return $data->filter(function($value, $key) {
            return $value->position == 6;
        });
    }
}

if (!function_exists('get_popup_ads')) {
    /**
     * @return array
     */
    function get_popup_ads($data)
    {
        return $data->filter(function($value, $key) {
            return $value->position == 7 && ($value->page == session('pageType') || $value->page == 0);
        });
    }
}

if (!function_exists('get_below_navigation_ads')) {
    /**
     * @return array
     */
    function get_below_navigation_ads($data)
    {
        return $data->filter(function($value, $key) {
            return $value->position == 8 && ($value->page == session('pageType') || $value->page == 0);
        });
    }
}


if (!function_exists('get_detail_top_ads')) {
    /**
     * @return array
     */
    function get_detail_top_ads($data)
    {
        return $data->filter(function($value, $key) {
            return $value->position == 10;
        });
    }
}

if (!function_exists('get_detail_middle_ads')) {
    /**
     * @param int $limit
     * @return array
     */
    function get_detail_middle_ads($data)
    {
        return $data->filter(function($value, $key) {
            return $value->position == 11;
        });
    }
}

if (!function_exists('get_detail_bottom_ads')) {
    /**
     * @param int $limit
     * @return array
     */
    function get_detail_bottom_ads($data)
    {
        return $data->filter(function($value, $key) {
            return $value->position == 12;
        });
    }
}