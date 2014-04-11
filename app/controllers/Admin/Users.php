<?php namespace Admin;
/**
 * User management controller
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created April 10th, 2014
 */

class Users extends BaseController {
  public function index() {
    return \View::make('admin.users');    
  }
}