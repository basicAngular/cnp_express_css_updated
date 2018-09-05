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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <a href="javascript:;" class="responsiveMenu" id="respNav"><i class="fa fa-bars"></i> Menu</a>
                    <ul class="list-inline menuList">
                        <li class="has-child"><a href="#">Tradeline Approval</a>
                            <ul class="sub-menu">
                                <li><a href="#">Sub Menu 1</a></li>
                                <li><a href="#">Sub Menu 2</a></li>
                                <li><a href="#">Sub Menu 3</a></li>
                                <li><a href="#">Sub Menu 4</a></li>
                            </ul>
                        </li>
                        <li class="has-child"><a href="#">My Client</a>
                            <ul class="sub-menu">
                                <li><a href="#">Sub Menu 1</a></li>
                                <li><a href="#">Sub Menu 2</a></li>
                                <li><a href="#">Sub Menu 3</a></li>
                                <li><a href="#">Sub Menu 4</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Client Information</a></li>
                        <li><a href="#">Task</a></li>
                        <li><a href="#">Broker Information</a></li>
                        <li><a href="#">Tradeline Information</a></li>
                        <li><a href="#">Vendoor Information</a></li>
                    </ul>
                </div><!-- col 12 -->
            </div><!-- row -->
        </div><!-- container -->
    </nav><!-- navigation row  -->
    <section class="container-fluid contentBox">
        <div class="right_cont">
            @yield('content')
        </div>
    </section>

    <div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    {{--<aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar-->
      <section class="sidebar">
            <div id="menu" role="navigation">
                <!-- / .navigation -->
                @if(Sentinel::inRole('admin') || Sentinel::inRole('staff'))
                    @include('left_menu._user')
                @elseif(Sentinel::inRole('customer'))
                    @include('left_menu._customer')
                @endif
            </div>
            <!-- menu -->
        </section>
        <!-- /.sidebar -->
    </aside>--}}
    <aside class="right-side right-padding">
        <div class="right-content">
            <!-- Content -->

                    <!-- /.content -->
        </div>
    </aside>
    <!-- /.right-side -->
</div>
<!-- /.right-side -->
<!-- ./wrapper -->
@include('layouts._newFooter')
@include('layouts._newFooterSection')
</div>
<!-- global js -->
@include('layouts._assets_footer')
@include('layouts.pusherjs')

@yield('scripts')
</body>
</html>