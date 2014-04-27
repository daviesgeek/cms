'use strict';

/**
 * Url friendly filter
 * @author Matthew Davies
 * @created April 26th, 2014
 */

module.exports = function() {
  return function(input, scope) {

    var output = input.replace(/[^a-zA-Z0-9]/g,' ').replace(/\s+/g,"-").toLowerCase();
    
    /* remove first dash */
    if(output.charAt(0) == '-') output = output.substring(1);
    
    /* remove last dash */
    var last = output.length-1;
    if(output.charAt(last) == '-') output = output.substring(0, last);

    return output;

  }
}