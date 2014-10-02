<?php

Route::resource('company', 'Lion\\Controllers\CompanyController');
Route::get('company/{id}/delete', [
    'as' => 'company.delete', 
    'uses' => 'Lion\\Controllers\\CompanyController@delete'
    ]
);
Route::get('company/deleted/items', [
    'as' => 'company.trash', 
    'uses' => 'Lion\\Controllers\\CompanyController@trash'
    ]
);
Route::get('company/{id}/restore', [
    'as' => 'company.restore',
    'uses' => 'Lion\\Controllers\\CompanyController@restore'
    ]
);