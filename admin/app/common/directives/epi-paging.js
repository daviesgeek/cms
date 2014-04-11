module.exports = function() {
  return {
    restrict: 'C',
    template: require('../views/directive-epi-paging'),
    scope: {
      pages: '=pages',
      collection: '=collection',
      verbosity: '@verbosity'
    },
    link: function(scope, element, attrs) {
      // console.log(scope);
      scope.nextPage = function() {
        this.page(this.pages.nextPage);
        console.log(scope);
      }


      scope.prevPage = function() {
        this.page(this.pages.prevPage);
      }


      scope.page = function(page) {
        this.collection.getList({page: page}).then(function(collection) {
          scope.collection = collection;
        })
      }
    }
  }
}