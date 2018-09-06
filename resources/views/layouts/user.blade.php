<!DOCTYPE html>
<html>
<head>
    @include('layouts._meta')
    @include('layouts._assets')
    @yield('styles')
</head>
<body>
<div id="newPage">
    @include('layouts._section')
    @include('layouts._newHeader')
    <nav class="container-fluid mainNavigation">
        <div class="container">
            @if(Sentinel::inRole('admin') || Sentinel::inRole('staff'))
                @include('upper_menu._newUser')
            @elseif(Sentinel::inRole('customer'))
                @include('upper_menu._newCustomer')
            @endif
        </div><!-- container -->
    </nav><!-- navigation row  -->

    <section class="container-fluid contentBox">
        <div class="right_cont">
            @yield('content')
        </div>
    </section>

    @include('layouts._newFooter')
    @include('layouts._newFooterSection')
</div>
<!-- global js -->
@include('layouts._assets_footer')
@include('layouts.pusherjs')

@yield('scripts')
</body>
</html>