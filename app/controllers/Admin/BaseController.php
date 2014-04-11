<?php namespace Admin;
/**
 * Base class for the admin controllers
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created March 30th, 2014
 */

class BaseController extends \BaseController {

  public function __construct() {
    $route = \Route::currentRouteName();
    $user = \Sentry::getUser();
    if(!$user->hasAccess($route)){
      \App::abort(403, 'You don\'t have access to view this page');
    }
  }

}