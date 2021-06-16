<?php

Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admins','jwt.auth']],function ()
{
	Route::post('login', 'AuthController@login');	
});



Route::group([

'middleware' => 'api',
'prefix' => 'auth'

], function ($router) {

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');
Route::post('me', 'AuthController@me');

});

Route::apiResource('/category', 'Api\CategoryController');
Route::apiResource('/user', 'Api\UserController');
Route::apiResource('/department', 'Api\DepartmentController');
Route::apiResource('/finance_category', 'Api\FinanceCategoryController');
Route::apiResource('/ol', 'Api\ObjekLanjutController');
Route::apiResource('/items', 'Api\ItemsController');
Route::apiResource('/pku', 'Api\PkuController');
Route::apiResource('/sku', 'Api\SkuController');
Route::apiResource('/optimum', 'Api\OptimumlevelController');
Route::apiResource('/finance/activity', 'Api\KodAktivitiController');

Route::post('/password/update/{id}', 'Api\UserController@edit');
Route::post('/password/selfupdate/{id}', 'Api\UserController@selfupdate');
Route::get('/items/view/{id}', 'Api\ItemsController@view');
Route::get('/optimum/view/{id}', 'Api\OptimumlevelController@view');
Route::get('/stock/out/{id}', 'Api\OptimumlevelController@showbydept');
Route::get('/items/out/{id}', 'Api\PosController@GetItem');
;