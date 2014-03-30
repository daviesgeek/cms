<?php namespace Admin;
/**
 * Base class for the admin controllers
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created March 30th, 2014
 */

class Base extends \BaseController {

  public function __construct() {
    echo 'Admin base class loaded';
  }

}