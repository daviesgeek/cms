<!DOCTYPE html>
<html lang="en-US" ng-app="admin/app">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes"/>
    {{ HTML::style('assets/_admin/css/app.css') }}
    {{ HTML::script('assets/_admin/js/vendor.js') }}
    {{ HTML::script('assets/_admin/js/views.js') }}
    {{ HTML::script('assets/_admin/js/app.js') }}
  <script type="text/javascript">require('admin/app')</script>
  @include('admin-angular')
</html>