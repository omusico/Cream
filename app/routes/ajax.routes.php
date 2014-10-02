<?php

// Company AJAX
Route::post('ajax/company/get-company',         'Lion\Controllers\Api\Ajax\CompanyAjaxController@getCompany');
Route::post('ajax/company/load-companies',      'Lion\Controllers\Api\Ajax\CompanyAjaxController@loadCompanies');

// Actions AJAX
Route::post('ajax/action/load-actions',         'Lion\Controllers\Api\Ajax\ActionAjaxController@loadActions');
Route::post('ajax/action/store-action',         'Lion\Controllers\Api\Ajax\ActionAjaxController@storeAction');

// Company AJAX
Route::post('ajax/entity/get-entity',         'Lion\Controllers\Api\Ajax\EntityAjaxController@getEntity');
Route::post('ajax/entity/search-entities',    'Lion\Controllers\Api\Ajax\EntityAjaxController@searchEntities');