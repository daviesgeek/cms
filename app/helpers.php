<?php

/**
 * General helper functions
 * @author Matthew Davies <daviesgeek@icloud.com>
 * @created March 29th, 2014
 */


  /**
   * Formatted print_r
   * @param  object|array $target
   * @return void
   */
  function dump($target) {

    // If debugging is turned on
    if(\Config::get('app.debug') == 1) {
      
      echo '<pre>';
      print_r($target);
      echo '</pre>';    
    }
  }