<?php namespace Cms;
/**
 * Model for getting edits data out of the database
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created March 29th, 2014
 */

class Edit extends \Eloquent {

  static $pageEdits;

  /**
   * Gets a pages edits by url
   * @param  array $page
   * @param  boolean $returnClass whether to return a class or not
   * @return void|object either object or an instance of a class
   */
  public static function get($page, $returnClass=true) {
    
    // Get the edit sections and the edits
    $editSections = \DB::table('edit_section')->get();
    $edits = \DB::table('edit')->where('pageID', $page->id)->get();

    // Then loop over them and create the array of edits
    foreach ($editSections as $section) {
      foreach ($edits as $edit) {
        if($section->id == $edit->editSectionID){
          self::$pageEdits[$section->name] = $edit;
          break;
        }
      }
    }

    if($returnClass){
      return self::$pageEdits;
    }else{
      return new self;
    }
  }


}