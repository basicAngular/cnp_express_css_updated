@extends('layouts.user')
@section('title')
    {{trans('dashboard.dashboard')}}
@stop
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/c3.min.css') }}">
@stop
@section('content')
    <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="iconBox ibox1 animated slideInUp">
                        <a href="#">
                        	<span class="lIcon">
                            	<label><i class="fa fa-user-o"></i></label>
                             </span>
                            <span class="lValue">23,986</span>
                            <span class="lName">Clients</span>
                        </a>
                    </div><!-- icon box -->
                </div><!-- col 4/6/12 -->

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="iconBox ibox2 animated slideInUp">
                        <a href="#">
                        	<span class="lIcon">
                            	<label><i class="fa fa-check"></i></label>
                             </span>
                            <span class="lName">Tradeline Approval</span>
                        </a>
                    </div><!-- icon box -->
                </div><!-- col 4/6/12 -->

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="iconBox ibox3 animated slideInUp">
                        <a href="#">
                        	<span class="lIcon">
                            	<label><i class="fa fa-info"></i></label>
                             </span>
                            <span class="lName">Vendor Information</span>
                        </a>
                    </div><!-- icon box -->
                </div><!-- col 4/6/12 -->

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="iconBox ibox4 animated slideInUp">
                        <a href="#">
                        	<span class="lIcon">
                            	<label><i class="fa fa-cart-arrow-down"></i></label>
                             </span>
                            <span class="lValue">23,986</span>
                            <span class="lName">Order Tradeline</span>
                        </a>
                    </div><!-- icon box -->
                </div><!-- col 4/6/12 -->


                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="iconBox ibox5 animated slideInUp">
                        <a href="#">
                        	<span class="lIcon">
                            	<label><i class="fa fa-tasks"></i></label>
                             </span>
                            <span class="lName">My Task</span>
                        </a>
                    </div><!-- icon box -->
                </div><!-- col 4/6/12 -->

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="iconBox ibox6 animated slideInUp">
                        <a href="#">
                        	<span class="lIcon">
                            	<label><i class="fa fa-handshake-o"></i></label>
                             </span>
                            <span class="lName">Resource Center</span>
                        </a>
                    </div><!-- icon box -->
                </div><!-- col 4/6/12 -->

            </div><!-- row -->
        </div><!-- container -->
@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery-jvectormap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/d3.v3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/d3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/c3.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/countUp.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#respNav").click(function(){
                $(this).next("ul").slideToggle();
            });
        });

        $(window).on("load resize scroll",function(e){
            if (window.outerWidth > 767) {
                $("ul.menuList").removeAttr("style");
            }
        });

    </script>
@stop