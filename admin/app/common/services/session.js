/**
 * Session service
 */
module.exports = function($q, $http, API_ROOT) {
  var Session = function($http, API_ROOT) {
    this.attributes = {};
    this.$http = $http;
  };

  /**
   * Given a dictionary, set the session data
   * @param  {object} dict
   * @param {function} callback
   * @return {void}
   */
  Session.prototype.load = function(dict, callback) {
    // console.log(dict);
    for(i in dict) {
      this.attributes[i] = dict[i];
    }

    if(typeof callback != 'undefined')
      callback.call();
  }


  /**
   * Fetch from server
   * @param {function} callback
   */
  Session.prototype.fetch = function(callback) {
    var self = this;

    this.$http({'method': 'GET', 'url': API_ROOT + '/session'})
      .success(function(response) {
        self.load(response.data, callback);
      });
  }


  Session.prototype.getAll = function() {
    return this.attributes;
  }


  Session.prototype.get = function(key) {
    return this.attributes[key];
  }


  Session.prototype.set = function(key, val, doRequest) {
    var deferred = $q.defer();

    if(doRequest){
      var data = {};
      data[key] = val;
      this.$http({
          'method': 'PATCH',
          'url': API_ROOT + '/session',
          data:data })
          .success(function(){
            deferred.resolve();
          })
    }
    this.attributes[key] = val;
    if(doRequest)
      return deferred.promise;
  }


  return new Session($http, API_ROOT);
}