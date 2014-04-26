<?php namespace Cms; 
/**
 * Model to deal with the menu
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created March 31st, 2014
 */

class Menu extends \Eloquent{

  protected $table = 'menu';

  public function edits() {
    return $this->hasMany('\Cms\Edit', 'pageID');
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