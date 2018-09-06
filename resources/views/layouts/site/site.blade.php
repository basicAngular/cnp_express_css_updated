<!DOCTYPE html>
<html>
<head>
    @include('layouts._meta')
    @include('layouts.site._assets')
    @yield('styles')
</head>
<body>
<div id="newPage">
    @include('layouts.site._header')
    @include('layouts._newHeader')
    <nav class="container-fluid mainNavigation">

    </nav><!-- navigation row  -->
    <section class="container-fluid contentBox">
        <div class="right_cont">
            @yield('content')
        </div>
    </section>
</div>
<!-- global js -->
@include('layouts.site._footer')
@include('layouts.site._assets_footer')
@yield('scripts')
</body>
</html>