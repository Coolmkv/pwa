<!DOCTYPE html>
<html lang="en">
   <!-- Basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- Site Metas -->
   <title>@yield("title")</title>
   <head>
   @include("include.head")
   </head>
   <body id="home_page" class="home_page">
      <!-- header -->
   @include("include.header")
      
      <!-- end header -->
      @yield("content")
      <!-- footer -->
   @include("include.footer")      
      <!-- end footer -->
   @include("include.script")
     @yield("script")
   </body>
</html>
