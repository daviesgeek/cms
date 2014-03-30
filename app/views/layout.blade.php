<html>
  <head>
    {{ HTML::style('css/public.css') }}
    {{ HTML::script('js/public.js') }}
    <title>{{$title}}</title>
  </head>
  <header>
    
  </header>
  <body class="container">
    @yield('content')
  </body>
</html>
