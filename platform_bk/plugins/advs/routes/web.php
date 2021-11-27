<?php

Route::group(['namespace' => 'Botble\Advs\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'advs', 'as' => 'advs.'], function () {
            Route::resource('', 'AdvsController')->parameters(['' => 'advs']);

            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'AdvsController@deletes',
                'permission' => 'advs.destroy',
            ]);
        });
    });

    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {
        Route::get('advs', [
            'as'   => 'public.advs',
            'uses' => 'PublicController@getGalleries',
        ]);

        Route::get('advs/{slug}', [
            'as'   => 'public.advs',
            'uses' => 'PublicController@getGallery',
        ]);
    });
});