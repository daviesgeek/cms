/**
 * Scroll animation
 * Requires the parent of the element to have a class of .scroll-parent
 * Add a class of .scroll-top to the element
 * When you want to scroll, add .scroll-to to the element
 */


module.exports = function() {
  return {
    addClass : function(element, className, done){
      var parent = $(element).closest('.scroll-parent');
      var parentTop = $(parent).scrollTop();
      var eleTop = $(element).offset().top;
      var height = $(element).height();
      
      var target = parentTop + eleTop - height - 55;

      // console.log('parentTop: '+parentTop);
      // console.log('eleTop: '+eleTop);
      // console.log('height: '+height);
      // console.log('target: '+target);

      $(parent).animate({ scrollTop: target }, 1000);
      $(element).removeClass('scroll-to');
    }

  };
}