<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Site Metas -->

<head>
    @include('include.head')
</head>

<body id="page-top" class="politics_version">
    <!-- LOADER -->
    <div id="preloader">
        <div id="main-ld">
            <div id="loader"></div>
        </div>
    </div><!-- end loader -->
    <!-- END LOADER -->
    <!-- navigation -->
    @include('include.navigation')

    <!-- end navigation -->
    @yield('content')
    <!-- footer -->
    @include('include.footer')
    <!-- end footer -->
    @include('include.script')
    @yield('script')
</body>

</html>
