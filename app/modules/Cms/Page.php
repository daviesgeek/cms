<?php namespace Cms;
/**
 * Model to deal with the pages
 * @author  Matthew Davies <daviesgeek@icloud.com>
 * @created March 23rd, 2014
 */

class Page extends \Eloquent{

  static $page;
  static $edits;

  protected $table = 'menu';

  public function __construct() {
    
  }

  public function edit() {
    return $this->hasMany('Edit');
  }

  /**
   * Returns a page by id
   * @param  integer id
   * @return object
   */
  public function getPage($id) {
    return \DB::table('menu')->where('id', $id)->get();
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

  /**
   * Query scope for checking to see if a page is able to be displayed 
   */
  
  public function scopeActive($query) {
    return $query->where('active', 1);
  }


}