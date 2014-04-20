'use strict';
/**
 * Session provider
 */

module.exports = function($q, $http, API_ROOT) {
  var Session = function($http, API_ROOT) {
    this._data = {};
    this.$http = $http;
  };

  /**
   * Fetch the session data
   * @param  {Function} callback
   * @return {object}
   */
  Session.prototype.fetch = function(callback){
    var self = this;

    $.ajax({
      url: API_ROOT + '/session',
      type: "GET",
      async: false,
      xhrFields: {
        withCredentials: true
      }
    }, 'json').success(function(response) {
      self.setAll(response.data);
      return response.data;
    });
  }

  /**
   * Sets all the data
   * @param {object} data
   */
  Session.prototype.setAll = function(data) {
    for(var key in data){
      this._data[key] = data[key];
    }
  }

  /**
   * Returns the session data
   * @return {object}
   */
  Session.prototype.getAll = function() {
    return this._data;
  }

  return new Session($http, API_ROOT);
}