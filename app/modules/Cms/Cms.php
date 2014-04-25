<?php namespace CMS;

/**
 * Main CMS class
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created April 24th, 2014
 */

class CMS{

  protected $page;

  public function __construct(\Cms\Page $page) {
    $this->page = $page;
  }

  /**
   * Returns a list of pages
   * @return object
   */
  public function getPages() {
    $page = $this->page;
    return $page::all();
  }

  /**
   * Returns a page by id
   * @param  integer $id
   * @return object
   */
  public function getPage($id) {
    $page = $this->page;
    return $page::find($id);
  }

}