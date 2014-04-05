/**
 * Public.js
 */

$('#login').submit(function(e) {
  var data = $(this).serialize();
  $.post('/login', data, function(response) {
    window.location.href = window.makeURL(response.status.redirect);
  }, "json").error(function(response) {
    if('message' in response.responseJSON.status){
      $('.text-danger').text(response.responseJSON.status.message);
    }
  });
  e.preventDefault();
});
