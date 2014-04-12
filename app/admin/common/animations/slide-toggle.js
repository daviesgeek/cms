module.exports = function() {
	return {
    addClass : function(element, className, done){
    	jQuery(element).slideUp();
    },
    removeClass : function(element, className, done){
    	jQuery(element).slideDown();
    }
  };
}