<?php namespace Admin;
/**
 * Main Admin controller
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created April 10th, 2014
 */

class Admin extends BaseController {
  public function index() {
    return \View::make('admin');    
  }
}