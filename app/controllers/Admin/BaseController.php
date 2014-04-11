<?php namespace Admin;
/**
 * Base class for the admin controllers
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created March 30th, 2014
 */

class BaseController extends \BaseController {

  public function __construct() {

    // Get the current route name (corresponds with the Sentry permission name)
    $route = \Route::currentRouteName();

    // If the current user does not have access to this route, throw a 403
    if(!\Sentry::getUser()->hasAccess($route)){
      \App::abort(403, \Lang::get('errors.403'));
    }
  }

}