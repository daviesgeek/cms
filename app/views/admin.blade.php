<!DOCTYPE html>
<html lang="en-US" ng-app="app">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes"/>
    {{ HTML::style('assets/_/css/app.css') }}
    {{ HTML::script('assets/_/js/vendor.js') }}
    {{ HTML::script('assets/_/js/views.js') }}
    {{ HTML::script('assets/_/js/app.js') }}
  <script type="text/javascript">require('app')</script>
  @include('admin-angular')
</html>