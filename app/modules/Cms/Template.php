<?php namespace Cms;

/**
 * Model for templates
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created April 25th, 2014
 */

class Template extends \Eloquent {

  protected $table = 'template';

  public function page() {
    return $this->belongsTo('\Cms\Page', 'template');
  }

}