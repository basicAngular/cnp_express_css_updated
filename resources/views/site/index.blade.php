    @extends('layouts.site.site')
    {{-- Web site Title --}}
    @section('title')
        {{ $title }}
    @stop

    {{-- Content --}}
    @section('content')
        <div class="homepage-banner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="banner-content">
                            <h1> Instant Delivery! </h1>
                            <ul class="bannerList">
                                <li> Clean Scanned Numbers! </li>
                                <li> Tri-Merged! </li>
                                <li> Pick Your State! </li>
                            </ul>
                            <p> <a href="#" class="btn btn-primary"> Get Instant Delivery Now!  </a>
                            </p>
                            <a href="#" class="btn btn-info"> Click Here  </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <img src="{!! url('images/cpn-process-chart.png') !!}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <div class="main">
            <h2 class="automated-process">
                100% Automated Process
            </h2>

            <div class="process-chart">
                <img src="{!! url('images/automated-cpn-process.jpg') !!}" class="img-fluid">
            </div>
        </div>
    @stop
    {{-- Scripts --}}
    @section('scripts')
        <script>
            $menuTrack = false;
            $(".MenuBtn").click(function(){
                if($menuTrack==false){
                    $(this).addClass("active");
                    $(".mainMenu").addClass("active");
                    $menuTrack=true;
                }else{

                    $(this).removeClass("active");
                    $(".mainMenu").removeClass("active");
                    $(".mainMenu ul li ul.subMenu").removeClass("subActive");
                    $menuTrack=false;
                }
            });
            $("li.hadSubMenu > i").click(function(){
                $(".mainMenu ul li ul.subMenu").addClass("subActive");
            });
            $(".backMenu").click(function(){
                $(".mainMenu ul li ul.subMenu").removeClass("subActive");
            });
        </script>
    @stop