<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Gestion User</title>
  
    <link rel="stylesheet" href="{{asset('assets/bundles/bootstrap-social/bootstrap-social.css')}}">


    {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..200,0..1,-50..150" />
    <link rel="stylesheet" href="{{ asset('assets/bundles/pretty-checkbox/pretty-checkbox.min.css')}}">
    @stack('head')
    @include('layouts.partials.styles')

</head>

<body>
  <div class="loader"></div>
  <div id="app">

    @yield("login_layout")

    <div class="main-wrapper main-wrapper-1">
        @yield('app_layout')
    </div>
</div>
  
  @stack('script')
  @include('layouts.partials.scripts')
</body>
</html>
