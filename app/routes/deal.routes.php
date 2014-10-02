<?php

Route::resource('deal', 'Lion\Controllers\DealController');
Route::get('deal/{id}/delete', [
    'as' => 'deal.delete', 
    'uses' => 'Lion\\Controllers\\DealController@delete'
    ]
);
Route::get('deal/deleted/items', [
    'as' => 'deal.trash', 
    'uses' => 'Lion\\Controllers\\DealController@trash'
    ]
);
Route::get('deal/{id}/restore', [
    'as' => 'deal.restore',
    'uses' => 'Lion\\Controllers\\DealController@restore'
    ]
);
Route::get('deal/create/company/{id}', [
    'as' => 'deal.create.company',
    'uses' => 'Lion\\Controllers\\DealController@createWithCompany'
    ]
);
