<?php

Route::group(['namespace' => 'Botble\SimpleSlider\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => config('core.base.general.admin_dir'), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'simple-sliders', 'as' => 'simple-slider.'], function () {

            Route::resource('', 'SimpleSliderController')->parameters(['' => 'simple-slider']);

            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'SimpleSliderController@deletes',
                'permission' => 'simple-slider.destroy',
            ]);

            Route::post('sorting', [
                'as'         => 'sorting',
                'uses'       => 'SimpleSliderController@postSorting',
                'permission' => 'simple-slider.edit',
            ]);
        });

        Route::group(['prefix' => 'simple-slider-items', 'as' => 'simple-slider-item.'], function () {

            Route::resource('', 'SimpleSliderItemController')->except([
                'index',
                'destroy',
            ])->parameters(['' => 'simple-slider-item']);

            Route::get('list/{id}', [
                'as'   => 'index',
                'uses' => 'SimpleSliderItemController@index',
            ]);

            Route::get('delete/{id}', [
                'as'   => 'destroy',
                'uses' => 'SimpleSliderItemController@destroy',
            ]);

            Route::delete('delete/{id}', [
                'as'         => 'delete.post',
                'uses'       => 'SimpleSliderItemController@postDelete',
                'permission' => 'simple-slider-item.destroy',
            ]);
        });
    });

});
