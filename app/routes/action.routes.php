<?php

Route::resource('action', 'Cream\Action\Controllers\ActionController');
Route::get('action/new/{type}/{id}/{entity}',[
        'as' => 'action.new',
        'uses' => 'Cream\\Action\\Controllers\\ActionController@create'
    ]
);