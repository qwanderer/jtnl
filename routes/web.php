<?php




Route::get('/datatable', 'DatatableController@getIndex')->name("datatables");
Route::any('/datatable/data', 'DatatableController@anyData')->name("datatables.data");

Auth::routes();
Route::post('logout', 'Auth\LoginController@logout')->name("logout");

Route::get('/user', 'UserCab\ClaimController@index')->name('user_cab');
Route::resource('user/claim', 'UserCab\ClaimController', ["as"=>"user"]);

Route::get('/', 'ClaimController@index')->name('home');
Route::get('/{category?}', 'ClaimController@index')->name('claim.by_category');
Route::get('/{category}/{claim_id}', 'ClaimController@show')->name('claim.show');

