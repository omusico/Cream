<?php

Route::get('config/action/results', 'Cream\Config\ActionResult\Controllers\ActionResultController@index');

Route::resource('config/action/results/visit', 'Cream\Config\ActionResult\Controllers\VisitResultController');
Route::get('config/action/restuls/visit/{id}/delete', [
    'as' => 'config.action.results.visit.delete', 
    'uses' => 'Cream\Config\ActionResult\Controllers\VisitResultController@delete'
    ]
);
Route::resource('config/action/results/call', 'Cream\Config\ActionResult\Controllers\CallResultController');
Route::get('config/action/restuls/call/{id}/delete', [
    'as' => 'config.action.results.call.delete', 
    'uses' => 'Cream\Config\ActionResult\Controllers\CallResultController@delete'
    ]
);
Route::resource('config/action/results/email', 'Cream\Config\ActionResult\Controllers\EmailResultController');
Route::get('config/action/restuls/email/{id}/delete', [
    'as' => 'config.action.results.email.delete', 
    'uses' => 'Cream\Config\ActionResult\Controllers\EmailResultController@delete'
    ]
);