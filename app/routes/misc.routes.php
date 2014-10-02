<?php

// Tags AJAX
Route::post('ajax/tags/load-tags', 'Cream\Misc\Controllers\TagsAjaxController@loadTags');
Route::post('ajax/tags/store-tag', 'Cream\Misc\Controllers\TagsAjaxController@storeTag');
Route::post('ajax/tags/delete-tag', 'Cream\Misc\Controllers\TagsAjaxController@deleteTag');