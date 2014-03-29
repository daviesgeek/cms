<?php namespace Cms;
/**
 * Model to deal with the menu
 * @author  Matthew Davies <daviesgeek@icloud.com>
 * @created March 23rd, 2014
 */

class Menu extends \Eloquent{

  static $menu;

  public function __construct() {
    
  }

  public static function getAll() {
    self::$menu = \DB::table('menu')->where('status', '1')->get();
    return new self;
  }

  public function getEdits() {
    echo 'get edits';
  }

}