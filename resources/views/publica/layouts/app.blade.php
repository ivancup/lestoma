<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lestoma</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('publica.shared.head')
  </head>
  <body>
  @include('publica.shared.header')
    @yield('content')
    @include('publica.shared.footer')
     <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
    @include('publica.shared.scripts')
    @stack('functions')
    </body>
</html>
