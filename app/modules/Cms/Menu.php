<?php namespace Cms;
/**
 * Model to deal with the menu
 * @author  Matthew Davies <daviesgeek@icloud.com>
 * @created March 23rd, 2014
 */

class Menu extends \Eloquent{

  static $menu = array();

  public static function doesExist($page) {
    self::$menu = \DB::table('users')->get();
    return new static;
  }

}