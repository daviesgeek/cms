<?php namespace Cms;
/**
 * Model to deal with the pages
 * @author  Matthew Davies <daviesgeek@icloud.com>
 * @created March 23rd, 2014
 */

class Page extends \Eloquent{

  static $page;
  static $edits;

  public function __construct() {
    
  }

  /**
   * Checks to see if the page exists or not
   * And returns either a static instance of this class or false
   * @param  string $page
   * @return false|void
   */
  public static function doesExist($page) {

    // Get this page
    self::$page = \DB::table('menu')->where('url', $page)->first();
    
    // If this page exists
    if(!empty(self::$page)) {

      // Get the template name
      self::$page->template = \DB::table('template')->where('id', self::$page->template)->pluck('name');
      // Get the edits
      self::$edits = \Cms\Edit::get(self::$page, true);
      
      // Return a new instance of this class
      return new static;
    }else{

      // Else return false
      return false;
    }
  }

}