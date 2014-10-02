<?php

Route::get('config', array('as' => 'config.index', 'uses' => 'Lion\Controllers\Config\ConfigController@index'));


// Users config
Route::get('config/user',                 array('as' => 'config.user.index',            'uses' => 'Lion\Controllers\Config\UserConfigController@index'));
Route::post('config/user',                array('as' => 'config.user.store',            'uses' => 'Lion\Controllers\Config\UserConfigController@store'));
Route::put('config/user/update',          array('as' => 'config.user.update',           'uses' => 'Lion\Controllers\Config\UserConfigController@update'));
Route::get('config/user/{id}/destroy',    array('as' => 'config.user.destroy',          'uses' => 'Lion\Controllers\Config\UserConfigController@destroy'));


// Tasks config
Route::get('config/task',                 array('as' => 'config.task.index',            'uses' => 'Lion\Controllers\Config\TaskConfigController@index'));
Route::post('config/task',                array('as' => 'config.task.store',            'uses' => 'Lion\Controllers\Config\TaskConfigController@store'));
Route::put('config/task/reorder',         array('as' => 'config.task.reorder',          'uses' => 'Lion\Controllers\Config\TaskConfigController@reorder'));
Route::put('config/task/update',          array('as' => 'config.task.update',           'uses' => 'Lion\Controllers\Config\TaskConfigController@update'));
Route::get('config/task/{id}/destroy',    array('as' => 'config.task.destroy',          'uses' => 'Lion\Controllers\Config\TaskConfigController@destroy'));


// Status config
Route::get('config/status',                 array('as' => 'config.status.index',            'uses' => 'Lion\Controllers\Config\StatusConfigController@index'));
Route::post('config/status',                array('as' => 'config.status.store',            'uses' => 'Lion\Controllers\Config\StatusConfigController@store'));
Route::put('config/status/reorder',         array('as' => 'config.status.reorder',          'uses' => 'Lion\Controllers\Config\StatusConfigController@reorder'));
Route::put('config/status/update',          array('as' => 'config.status.update',           'uses' => 'Lion\Controllers\Config\StatusConfigController@update'));
Route::get('config/status/{id}/destroy',    array('as' => 'config.status.destroy',          'uses' => 'Lion\Controllers\Config\StatusConfigController@destroy'));

// Status config
Route::get('config/sources',                 array('as' => 'config.sources.index',          'uses' => 'Lion\Controllers\Config\SourcesConfigController@index'));
Route::post('config/sources',                array('as' => 'config.sources.store',          'uses' => 'Lion\Controllers\Config\SourcesConfigController@store'));
Route::put('config/sources/reorder',         array('as' => 'config.sources.reorder',        'uses' => 'Lion\Controllers\Config\SourcesConfigController@reorder'));
Route::put('config/sources/update',          array('as' => 'config.sources.update',         'uses' => 'Lion\Controllers\Config\SourcesConfigController@update'));
Route::get('config/sources/{id}/destroy',    array('as' => 'config.sources.destroy',        'uses' => 'Lion\Controllers\Config\SourcesConfigController@destroy'));

// Deal stages config
Route::get('config/stages',                 array('as' => 'config.stages.index',            'uses' => 'Lion\Controllers\Config\StagesConfigController@index'));
Route::post('config/stages',                array('as' => 'config.stages.store',            'uses' => 'Lion\Controllers\Config\StagesConfigController@store'));
Route::put('config/stages/update',          array('as' => 'config.stages.update',           'uses' => 'Lion\Controllers\Config\StagesConfigController@update'));
Route::get('config/stages/{id}/destroy',    array('as' => 'config.stages.destroy',          'uses' => 'Lion\Controllers\Config\StagesConfigController@destroy'));

// Action types config
Route::get('config/actiontypes',                 array('as' => 'config.actiontypes.index',          'uses' => 'Lion\Controllers\Config\ActionTypesConfigController@index'));
Route::post('config/actiontypes',                array('as' => 'config.actiontypes.store',          'uses' => 'Lion\Controllers\Config\ActionTypesConfigController@store'));
Route::put('config/actiontypes/reorder',         array('as' => 'config.actiontypes.reorder',        'uses' => 'Lion\Controllers\Config\ActionTypesConfigController@reorder'));
Route::put('config/actiontypes/update',          array('as' => 'config.actiontypes.update',         'uses' => 'Lion\Controllers\Config\ActionTypesConfigController@update'));
Route::get('config/actiontypes/{id}/destroy',    array('as' => 'config.actiontypes.destroy',        'uses' => 'Lion\Controllers\Config\ActionTypesConfigController@destroy'));