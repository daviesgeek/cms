<html>
  <head>
    {{ HTML::style('assets/public.css') }}
    {{ HTML::script('assets/vendor.js') }}
    <title>{{$title}}</title>
  </head>
  <header>
    
  </header>
  <body class="container">
    @yield('content')
  </body>
  {{ HTML::script('assets/public.js') }}
  <script type="text/javascript">
    window.makeURL = function(url) {
      return '{{ URL::to('/') }}'+'/'+url.replace(/^\/|\/$/g, '');
    }
  </script>
  <script type="text/javascript">require('assets/js/public')</script>
</html>
