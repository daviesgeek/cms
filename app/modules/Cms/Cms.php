<?php namespace CMS;

/**
 * Main CMS class
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created April 24th, 2014
 */

class CMS{

  protected $pageProvider;
  protected $editProvider;

  public function __construct(\Cms\Page $pageProvider, \Cms\Edit $editProvider) {
    $this->pageProvider = $pageProvider;
    $this->editProvider = $editProvider;
  }

  public function page() {
    return $this->pageProvider;
  }

  public function edit() {
    return $this->editProvider;
  }

  /**
   * Returns a pageProvider item by id
   * @param  integer $id
   * @return object
   */
  public function getPage($id) {
    $pageProvider = $this->pageProvider;
    return $pageProvider::find($id);
  }

  /**
   * Finds and returns a page by url
   * @param  string $url 
   * @return false|array
   */
  public function findPageByUrl($url) {
    $pageProvider = $this->pageProvider;
    $page = $pageProvider::with(array('edits', 'edits.edit_section'))->where('url', $url)->first();

    if(empty($page)){
      return false;
    }else{
      $page = $page->toArray();
    }

    if(!empty($page['edits'])){
      $page['edits'] = $this->structureEdits($page['edits']);
    }else{
      $page['edits'] = false;
    }

    return $page;
  }

  /**
   * Restructure the edits array so that the name is the key
   * @param  array $edits
   * @return false|array
   */
  private function structureEdits($edits) {
    if(empty($edits))
      return false;

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