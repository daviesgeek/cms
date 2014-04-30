<!DOCTYPE html>
<html lang="en-US" ng-app="admin/app" class="skin-black wysihtml5-supported pace-done">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes"/>
    {{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css') }}
    {{ HTML::style('assets/_admin/css/vendor.css') }}
    {{ HTML::style('assets/_admin/css/app.css') }}
    {{ HTML::script('assets/_admin/js/vendor.js') }}
    {{ HTML::script('assets/_admin/js/views.js') }}
    {{ HTML::script('assets/_admin/js/app.js') }}
  <script type="text/javascript">require('admin/app')</script>
  @include('admin-angular')
</html>