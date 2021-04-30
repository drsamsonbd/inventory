<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['prefix' => 'admin','middleware' => ['assign.guard:admins','jwt.auth']],function ()
{
	Route::get('/demo','AdminController@demo');	
});

Route::group(['prefix' => 'subadmin','middleware' => ['assign.guard:subadmins','jwt.auth']],function ()
{
	Route::get('/demo','SubadminController@demo');	
});

Route::group(['prefix' => 'user','middleware' => ['assign.guard:admins','jwt.auth']],function ()
{
	Route::get('/demo','UserController@demo');	
});