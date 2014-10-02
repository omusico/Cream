<?php

Route::resource('people', 'Lion\Controllers\PeopleController');
Route::get('people/{id}/delete', [
    'as' => 'people.delete', 
    'uses' => 'Lion\\Controllers\\PeopleController@delete'
    ]
);
Route::get('people/deleted/items', [
    'as' => 'people.trash', 
    'uses' => 'Lion\\Controllers\\PeopleController@trash'
    ]
);
Route::get('people/{id}/restore', [
    'as' => 'people.restore',
    'uses' => 'Lion\\Controllers\\PeopleController@restore'
    ]
);
Route::get('people/create/company/{id}', [
    'as' => 'people.create.company',
    'uses' => 'Lion\\Controllers\\PeopleController@createWithCompany'
    ]
);