module.exports = function() {
  return {
    addClass : function(element, className, done){
      jQuery(element).hide("slide", {direction: "left"});
    },
    removeClass : function(element, className, done){
      jQuery(element).show("slide", {direction: "left"})
    }
  };
}