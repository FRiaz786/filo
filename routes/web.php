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

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::resource('posts', 'PostsController');


/*
Route::get('/users/{id}', function($id){
    return 'this is user '.$id;
});

Route::get('/hello', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('requests', 'RequestController');

Route::get('/requests/create/{id}', 'RequestController@create')->name('requests.create');

Route::get('/requests/approve/{id}', 'RequestController@approveRequest');

Route::get('/requests/revoke/{id}', 'RequestController@revokeRequest');