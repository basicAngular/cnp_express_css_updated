<section class="container-fluid topHeader">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="pull-left">
                    <p>Phone: Call Or Text (951) 303-4832 Or (909)978-9978</p>
                </div>
                <div class="pull-right">
                    <ul class="list-inline">
                        <li><i class="fa fa-envelope" aria-hidden="true"></i> {{ Settings::get('site_email') }} </li>
                        <li>Welcome to <strong>{{ Settings::get('site_name') }}</strong> </li>
                        <li class="nav-item dropdown">
                            <span data-toggle="dropdown" class=" dropdown-toggle custom-caret caret "></span>
                            <ul class="dropdown-menu">
                                @if (Sentinel::inRole('admin'))
                                    <li>
                                        <a href="{{url('setting')}}" class="dropdown-item">
                                            <span>{{trans('left_menu.settings')}}</span>
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{url('profile')}}" class="dropdown-item">
                                        <span>{{trans('left_menu.profile')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('logout')}}" class="dropdown-item">
                                        {{trans('left_menu.logout')}}
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>

                </div>
            </div><!-- col 12 -->
        </div>
    </div>
</section><!-- blue row  -->