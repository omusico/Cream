<?php

Route::resource('config/people/salutation', 'Cream\Config\PeopleSalutation\Controllers\PeopleSalutationController');
Route::get('config/people/salutation/{id}/delete', [
    'as' => 'config.people.salutation.delete', 
    'uses' => 'Cream\Config\PeopleSalutation\Controllers\PeopleSalutationController@delete'
    ]
);