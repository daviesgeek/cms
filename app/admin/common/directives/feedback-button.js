'use strict';

/**
 * Directive for a button that provides feedback when a request is made
 * @author Matthew Davies
 * @created April 26th, 2014
 */

module.exports = function() {
  return {
    restrict: 'A',
    link: function(scope, element, attrs) {

      // Get the promise tracker
      var tracker = scope[attrs.feedbackTracker];

      var disabledClass = 'disabled';

      // Watch the tracker
      scope.$watch(tracker.active, function(val, oldVal) {

        // When it changes to active, change the html/text in the button
        if(val == true){
          element.html('<i class="fa fa-spinner fa-spin"></i> '+attrs.feedbackHtml).addClass(disabledClass);

        // When it changes to inactive, change the text back to what it was
        }else{
          element.html(attrs.feedbackButton).removeClass(disabledClass);
        }

      }, true);
    }
  }
}