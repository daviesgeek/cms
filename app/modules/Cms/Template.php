<?php namespace Cms;

/**
 * Model for templates
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created April 25th, 2014
 */

class Template extends \Eloquent {

  protected $table = 'template';

  public function pages() {
    return $this->hasMany('\Cms\Page');
  }

} 