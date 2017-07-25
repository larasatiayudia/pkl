<?php

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
    return view('auth.login');
});






Route::get('/formajax/{id}', 'AjaxController@jabatanform');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth','admin']],function(){
  Route::get('/dashboard','AdminController@index');
  Route::put('/dashboard','AdminController@update');
  Route::delete('/dashboard/{id}','AdminController@delete');
});
Route::group(['middleware' => ['auth']],function(){
  Route::get('/home', function () {
    return view('user.home');
	});
  Route::get('/jangkapendek', function () {
    return view('user.jangkapendek');
  });
});
