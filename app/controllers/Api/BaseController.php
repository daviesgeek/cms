<?php namespace Api;
/**
 * Base class for the api controllers
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created March 30th, 2014
 */

class BaseController extends \BaseController {

  public function __construct() {

    // Get the current route name (corresponds with the Sentry permission name)
    $route = \Route::currentRouteName();

    // If the current user does not have access to this route (or isn't logged in, throw a 403
    if(!\Sentry::getUser()->hasAccess($route)){
      $this->response = array(
        'data' => array(),
        'code' => '403',
        'message' => \Lang::get('403json')
      );

      // If the user isn't logged in, change the message
      if(!\Sentry::check()){
        $this->response['message'] = \Lang::get('403login');
      }
    }
  }

}