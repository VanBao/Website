<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield('title')</title>
      <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{URL::asset('css/style.css')}}">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <script type="text/javascript" src="{{URL::asset('js/jquery.min.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
      <script type="text/javascript" src="{{URL::asset('js/javascript.js')}}"></script>
      <meta property="fb:app_id" content="350177222049097" />
      <meta property="fb:admins" content="100008378976882"/>
   </head>
   <body>
      <div class="container" >
         <!--header-->
         @include("layout.header")
         <!--header-->
         <!--content-->
         @yield("content")
         <!--content-->
         <!--footer-->
         @include("layout.footer")
         <!--footer-->
      </div>
   </body>
</html>