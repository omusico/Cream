<?php

// Route::resource('task', 'Lion\Controllers\TaskController');

Route::get('task',                      ['as' => 'task.index',      'uses' => 'Lion\Controllers\TaskController@index']);
Route::post('task',                     ['as' => 'task.store',      'uses' => 'Lion\Controllers\TaskController@store']);
Route::get('task/{id}',                 ['as' => 'task.show',       'uses' => 'Lion\Controllers\TaskController@show']);
Route::put('task/update/{id}',          ['as' => 'task.update',     'uses' => 'Lion\Controllers\TaskController@update']);
Route::get('task/{id}/edit',            ['as' => 'task.edit',       'uses' => 'Lion\Controllers\TaskController@edit']);
Route::get('task/perform/{id}',         ['as' => 'task.perform',    'uses' => 'Lion\Controllers\TaskController@perform']);
Route::get('task/create/{type}',        ['as' => 'task.create',     'uses' => 'Lion\Controllers\TaskController@create']);
Route::get('task/delete/{id}',          ['as' => 'task.delete',    'uses' => 'Lion\Controllers\TaskController@delete']);
Route::get('task/restore/{id}',         ['as' => 'task.restore',    'uses' => 'Lion\Controllers\TaskController@restore']);
