<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::resource('login', 'LoginController', array('before' => 'guest', 'as' => 'login'));
Route::get('logout', 'LogoutController@index')->before('loggedIn');
Route::post('create-user', 'LoginController@createUser');

Route::group(array(
  'prefix' => 'admin',
  'before' => 'loggedIn',
  'namespace' => 'Admin'),
  function() {
  
    Route::get('', array('as' => 'admin.home', 'uses' => 'AdminController@index'));

});

Route::get('{slug?}', array(
  'as'    => 'CMS',
  'uses'  => 'CMSController@index'
))->where('slug', '.+');

App::missing(function($exception) {
  return Response::view('errors.missing', array(), 404);
});