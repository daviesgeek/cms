/**
 * Capitalize filter
 */

module.exports = function() {
  return function(input, scope) {
    return input.substring(0,1).toUpperCase()+input.substring(1);
  }
}