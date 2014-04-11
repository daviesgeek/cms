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

Route::get('/', 'Home@index');

Route::resource('login', 'Login', array(
  'before' => 'guest',
  'as'     => 'login'
));

Route::get('logout', 'Logout@index')->before('loggedIn');
Route::post('create-user', 'Login@createUser');

Route::group(array(
  'prefix'    => 'admin',
  'before'    => 'loggedIn',
  'namespace' => 'Admin'),
  function() {
  
    Route::get('', array(
      'as'   => 'admin.home',
      'uses' => 'Admin@index'
    ));

});

Route::group(array(
  'prefix'    => 'api',
  'before'    => 'loggedIn',
  'namespace' => 'Api'),
  function() {

});

Route::get('{slug?}', array(
  'as'    => 'CMS',
  'uses'  => 'CMS@index'
))->where('slug', '.+');

App::missing(function($exception) {
  return Response::view('errors.missing', array(), 404);
});