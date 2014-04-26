<?php namespace Cms;

/**
 * Model for dealing with edit sections
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created April 25th, 2014
 */

class EditSection extends \Eloquent {
  protected $table = 'edit_section';

  public function edit(){
    return $this->hasMany('\Cms\Edit', 'edit_section_id');
  }

}