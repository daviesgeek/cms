<?php namespace Cms;
/**
 * Model for getting edits data out of the database
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created March 29th, 2014
 */

class Edit extends \Eloquent {

  static $pageEdits;

  /**
   * Gets a edits by a page url
   * @param  [array] $page
   * @return [object] edits object
   */
  public static function get($page) {
    
    // Get the edit sections and the edits
    $editSections = \DB::table('edit_section')->get();
    $edits = \DB::table('edit')->where('pageID', $page->id)->get();

    // Then loop over them and create the array of 
    foreach ($editSections as $section) {
      foreach ($edits as $edit) {
        if($section->id == $edit->editSectionID){
          self::$pageEdits[$section->name] = $edit;
          break;
        }        
      }
    }

    return new self;
  }


}