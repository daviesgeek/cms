@if($editAccess == true)
<html ng-app="admin/app">  
@else
<html>
@endif

  <head>
    {{ HTML::style('assets/public.css') }}
    {{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css') }}
    @if ($editAccess == true)
      {{ HTML::style('assets/_admin/css/vendor.css') }}
      {{ HTML::style('assets/_admin/css/app.css') }}
      {{ HTML::script('assets/_admin/js/vendor.js') }}
      {{ HTML::script('assets/_admin/js/views.js') }}
      {{ HTML::script('assets/_admin/js/app.js') }}
    @endif
    <title>{{$title}}</title>
  </head>
  <header>
    
  </header>
  <body class="container">
    @yield('content')
  </body>
  {{ HTML::script('assets/public.js') }}
  @if ($editAccess == true)
    <script type="text/javascript">
      require('admin/app');
      window.pageID = {{$pageID}}
    </script>
  @endif
  <script type="text/javascript">
    window.makeURL = function(url) {
      return '{{ URL::to('/') }}'+'/'+url.replace(/^\/|\/$/g, '');
    }
  </script>
  <script type="text/javascript">require('assets/js/public')</script>
</html>
