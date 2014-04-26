<?php namespace CMS;

/**
 * Main CMS class
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created April 24th, 2014
 */

class CMS{

  protected $menu;
  protected $edit;

  public function __construct(\Cms\Menu $menu, \Cms\Edit $edit) {
    $this->menu = $menu;
    $this->edit = $edit;
  }

  /**
   * Returns the menu list
   * @return object
   */
  public function getPages() {
    $menu = $this->menu;
    return $menu::all();
  }

  /**
   * Returns a menu item by id
   * @param  integer $id
   * @return object
   */
  public function getPage($id) {
    $menu = $this->menu;
    return $menu::find($id);
  }

  /**
   * Finds and returns a page by url
   * @param  string $url 
   * @return false|object
   */
  public function findPageByUrl($url) {
    $menu = $this->menu;
    $page = $menu::with(array('edits', 'edits.edit_section'))->where('url', $url)->first();
    $return = $page->toArray();
    $return['edits'] = $this->structureEdits($return['edits']);
    var_dump($return);
    exit;
    // return $menu->findByUrl($url);
  }

  /**
   * Restructure the edits array so that the name is the key
   * @param  array $edits
   * @return array
   */
  private function structureEdits($edits) {
    // Create a new array
    $newEdits = array();

    // Loop through the edits
    foreach ($edits as $edit) {
      // Take the edit_section name and make it the key of the new array
      $newEdits[$edit['edit_section']['name']] = $edit;
    }
    unset($edit);
    return $newEdits;
  }

}