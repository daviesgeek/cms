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

  /**
   * Gets all the menu items then returns a new instance of this class
   * @return Class instance of the \CMS\Menu class
   */
  public static function getAll() {
    self::$menu = \DB::table('menu')->where('status', '1')->get();
    return new self;
  }

  /**
   * Checks to see if the page exists or not
   * @param  string $url
   * @return boolean
   */
  public static function doesPageExist($url) {
    $page = \DB::table('menu')->where('url', $url);
    print_r($page);
  }

}