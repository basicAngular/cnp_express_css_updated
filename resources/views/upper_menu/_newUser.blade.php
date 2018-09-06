<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a href="javascript:;" class="responsiveMenu" id="respNav"><i class="fa fa-bars"></i> Menu</a>
        <ul class="list-inline menuList navigation">
            <li {!! (Request::is( '/') ? 'class="active"' : '') !!}>
                <a href="{{url('/')}}">
                    <span class="nav-icon"><i class="material-icons">dashboard</i></span>
                    <span class="nav-text"> {{trans('left_menu.dashboard')}}</span>
                </a>
            </li>

            {{-- second menu--}}
            @if(isset($user_data) && ($user_data->hasAccess(['leads.read'])
            || $user_data->inRole('admin')))
                <li {!! (Request::is( 'lead') ? 'class="active"' : '') !!}>
                    <a href="{{url('lead')}}"><i class="material-icons ">thumb_up</i>
                        <span class="nav-text">{{trans('left_menu.leads')}}</span>
                    </a>
                </li>
            @endif
            {{-- product menu--}}
            @if(isset($user_data) && ($user_data->hasAccess(['leads.read'])
            || $user_data->inRole('admin')))
                <li {!! (Request::is( 'products/*')
                || Request::is( 'category')
                || Request::is( 'product')
                || Request::is( 'sales')
                || Request::is( 'invoice_delete_list')
                || Request::is('paid_invoice') ? 'class="active"' : '') !!}
                    class="has-child">
                    <a href="#">
                        <span class="nav-icon"><i class="material-icons ">shopping_basket</i></span>
                        <span class="nav-text">{{trans('left_menu.products')}}</span>
                    </a>
                    <ul class="sub-menu">
                        <li {!! (Request::is( 'product/*') || Request::is( 'product') ? 'class="active"' : '') !!}>
                            <a href="{{url('product')}}">
                                <i class="material-icons">layers</i>
                                <span class="nav-text">{{trans('left_menu.products')}}</span></a>
                        </li>
                        <li {!! (Request::is( 'category/*') || Request::is( 'category') ? 'class="active"' : '') !!}>
                            <a href="{{url('category')}}">
                                <i class="material-icons">gamepad</i>
                                <span class="nav-text">{{trans('left_menu.category')}}</span></a>
                        </li>
                    </ul>
                </li>
            @endif


            {{-- invoice menu --}}
            @if(isset($user_data) && ($user_data->hasAccess(['invoices.read']) || $user_data->inRole('admin')))
           <li {!! (Request::is( 'invoice/*')
            || Request::is( 'invoice') || Request::is( 'invoices_payment_log/*')
            || Request::is( 'invoices_payment_log')
            || Request::is( 'invoice_delete_list')
            || Request::is('paid_invoice') ? 'class="active"' : '') !!}
             class="has-child">
            <a href="#">
                <span><i class="material-icons ">web</i></span>
                <span class="nav-text">{{trans('left_menu.invoices')}}</span>
            </a>
            <ul class="sub-menu">
                <li {!! (Request::is( 'invoice/*')
                || Request::is( 'invoice')
                || Request::is( 'invoice_delete_list')
                || Request::is('paid_invoice') ? 'class="active"' : '') !!}>
                    <a href="{{url('invoice')}}"><i class="material-icons ">receipt</i>
                        <span class="nav-text">{{trans('left_menu.invoices')}}</span>
                    </a>
                </li>
                <li {!! (Request::is( 'invoices_payment_log/*')
                    || Request::is( 'invoices_payment_log') ? 'class="active"' : '') !!}>
                    <a href="{{url('invoices_payment_log')}}">
                        <i class="material-icons ">archive</i>
                        <span class="nav-text">{{trans('left_menu.payment_log')}}</span>
                    </a>
                </li>
            </ul>
            </li>
        @endif

        {{-- task menu--}}
        <li {!! (Request::is( '/task/*') || Request::is( 'task') ? 'class="active"' : '') !!}>
            <a href="{{url('/task')}}">
                <span class="nav-icon"><i class="material-icons">event_task</i></span>
                <span class="nav-text"> {{trans('left_menu.tasks')}}</span>
            </a>
        </li>

       {{-- Staff Users --}}
       @if(isset($user_data) && ($user_data->hasAccess(['leads.read']) || $user_data->inRole('admin')))
        <li {!! (Request::is( 'staff*') || Request::is( 'staff/*')
        || Request::is( 'staff') ? 'class="active"' : '')
        !!} class="has-child">
                <a href="#">
                    <span class="nav-icon"><i class="material-icons">people_outline</i></span>
                    <span class="nav-text">{{trans('left_menu.user')}}</span>
                </a>
                <ul class="sub-menu">
                    <li {!! (Request::is( 'staff/*')
                    || Request::is( 'staff')
                    || Request::is( 'staff/admin')
                    || Request::is( 'staff/client')
                    || Request::is('staff/broker') ? 'class="active"' : '') !!}>
                        <a href="{{url('staff/admin')}}"><i class="material-icons">people_outline</i>
                            <span class="nav-text">{{trans('left_menu.admin')}}</span>
                        </a>
                    </li>

                    <li {!! (Request::is( 'staff/admin*')
                    || Request::is( 'staff/admin')
                    || Request::is( 'staff/client')
                    || Request::is('staff/broker') ? 'class="active"' : '') !!}>
                        <a href="{{url('staff/broker')}}"><i class="material-icons">people_outline</i>
                            <span class="nav-text">{{trans('left_menu.broker')}}</span>
                        </a>
                    </li>

                    <li {!! (Request::is( 'staff/client*')
                    || Request::is( 'staff/admin')
                    || Request::is( 'staff/client')
                    || Request::is('staff/broker') ? 'class="active"' : '') !!}>
                        <a href="{{url('staff/client')}}"><i class="material-icons">people_outline</i>
                            <span class="nav-text">{{trans('left_menu.client')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif


        {{--Setting menu--}}
        @if(isset($user_data) && $user_data->inRole('admin'))
        <li {!! (Request::is( 'setting*') ? 'class="active"' : '') !!} class="has-child">
                    <a href="#">
                        <span class="nav-icon"><i class="material-icons">settings</i></span>
                        <span class="nav-text">{{trans('left_menu.setting')}}</span>
                    </a>
                    <ul class="sub-menu">
                        <li {!! (Request::is( 'setting/*') || Request::is( 'setting') ? 'class="active"' : '') !!}>
                            <a href="{{url('setting')}}">
                                <span class="nav-icon"><i class="material-icons">settings</i></span>
                                <span class="nav-text">{{trans('left_menu.settings')}}</span>
                            </a>
                        </li>

                        <li {!! (Request::is( 'email_template/*') || Request::is( 'email_template') ? 'class="active"' : '') !!}>
                            <a href="{{url('email_template')}}">
                                <span class="nav-icon"><i class="material-icons">email</i></span>
                                <span class="nav-text">{{trans('left_menu.email_template')}}</span>
                            </a>
                        </li>

                        <li {!! (Request::is( 'option/*') || Request::is( 'option') ? 'class="active"' : '') !!}>
                            <a href="{{url('option')}}">
                                 <span class="nav-icon"><i class="material-icons">dashboard</i></span>
                                 <span class="nav-text">{{trans('left_menu.options')}}</span>
                            </a>
                        </li>

                        <li {!! (Request::is( 'backup/*') || Request::is( 'backup') ? 'class="active"' : '') !!}>
                            <a href="{{url('backup')}}">
				                <span class="nav-icon"><i class="material-icons">backup</i></span>
                                <span class="nav-text">{{trans('left_menu.backup')}}</span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endif

            <li class="has-child"><a href="#">My Client</a>
                    <ul class="sub-menu">
                        <li><a href="#">Sub Menu 1</a></li>
                        <li><a href="#">Sub Menu 2</a></li>
                        <li><a href="#">Sub Menu 3</a></li>
                        <li><a href="#">Sub Menu 4</a></li>
                    </ul>
                </li>
            </ul>
    </div><!-- col 12 -->
</div><!-- row -->


{{--<div class="nav_profile">
    <div class="media profile-left">
        <a class="pull-left profile-thumb" href="{{url('/profile')}}">
            @if($user_data->user_avatar)
                <img src="{!! url('/').'/uploads/avatar/'.$user_data->user_avatar !!}" alt="img"
                     class="img-rounded"/>
            @else
                <img src="{{ url('uploads/avatar/user.png') }}" alt="img" class="img-rounded"/>
            @endif
        </a>
        <div class="content-profile">
            <h4 class="media-heading">{{ str_limit($user_data->full_name, 25) }}</h4>
            <ul class="icon-list">
                <li>
                    <a href="{{ url('mailbox') }}#/m/inbox" title="Email">
                        <i class="fa fa-fw fa-envelope"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ url('sales_order') }}" title="Sales Order" >
                        <i class="fa fa-fw fa-usd"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ url('invoice') }}" title="Invoices" >
                        <i class="fa fa-fw fa-file-text"></i>
                    </a>
                </li>
                @if(Sentinel::inRole('admin'))
                <li>
                    <a href="{{ url('setting') }}" title="Settings" >
                        <i class="fa fa-fw fa-cog"></i>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>--}}

{{--<ul class="navigation">
    <li {!! (Request::is( '/') ? 'class="active"' : '') !!}>
        <a href="{{url('/')}}">
            <span class="nav-icon">
         <i class="material-icons">dashboard</i>
        </span>
            <span class="nav-text"> {{trans('left_menu.dashboard')}}</span>
        </a>
    </li>

    @if(isset($user_data) && ($user_data->hasAccess(['opportunities.read']) || $user_data->inRole('admin')))
    <li {!! (Request::is( 'opportunity*') || Request::is( 'opportunity') ? 'class="active"' : '') !!}>
        <a href="{{url('opportunity')}}">
            <span class="nav-icon">
         <i class="material-icons ">event_seat</i>
        </span>
            <span class="nav-text">{{trans('left_menu.opportunities')}}</span>
        </a>
    </li>
    @endif



    @if(isset($user_data) && ($user_data->hasAccess(['quotations.read']) || $user_data->inRole('admin')))
    <li {!! (Request::is( 'quotation/*') || Request::is( 'quotation')|| Request::is( 'quotation*') ? 'class="active"' : '') !!}>
        <a href="{{url('quotation')}}">
            <i class="material-icons ">receipt</i>
            <span class="nav-text">{{trans('left_menu.quotations')}}</span></a>
    </li>
    @endif
    @if(isset($user_data) && ($user_data->hasAccess(['invoices.read']) || $user_data->inRole('admin')))
    <li {!! (Request::is( 'invoice/*') || Request::is( 'invoice') || Request::is( 'invoices_payment_log/*') || Request::is( 'invoices_payment_log')
        || Request::is( 'invoice_delete_list') || Request::is('paid_invoice') ? 'class="active"' : '') !!}>
        <a>
            <span class="nav-caret pull-right">
                <i class="fa fa-angle-right"></i>
            </span>
            <span class="nav-icon">
            <i class="material-icons ">web</i>
        </span>
            <span class="nav-text">{{trans('left_menu.invoices')}}</span>
        </a>
        <ul class="nav-sub">
            <li {!! (Request::is( 'invoice/*') || Request::is( 'invoice') || Request::is( 'invoice_delete_list') || Request::is('paid_invoice') ? 'class="active"' : '') !!}>
                <a href="{{url('invoice')}}">
                    <i class="material-icons ">receipt</i>
                    <span class="nav-text">{{trans('left_menu.invoices')}}</span></a>
            </li>
            <li {!! (Request::is( 'invoices_payment_log/*') || Request::is( 'invoices_payment_log') ? 'class="active"' : '') !!}>
                <a href="{{url('invoices_payment_log')}}">
                    <i class="material-icons ">archive</i>
                    <span class="nav-text">{{trans('left_menu.payment_log')}}</span></a>
            </li>
        </ul>
    </li>
    @endif @if(isset($user_data) && ($user_data->hasAccess(['sales_team.read']) || $user_data->inRole('admin')))
    <li {!! (Request::is( 'salesteam/*') || Request::is( 'salesteam') ? 'class="active"' : '') !!}>
        <a href="{{url('salesteam')}}">
            <span class="nav-icon">
         <i class="material-icons ">groups</i>
        </span>
            <span class="nav-text"> {{trans('left_menu.salesteam')}}</span>
        </a>
    </li>
    @endif @if(isset($user_data) && ($user_data->hasAccess(['logged_calls.read']) || $user_data->inRole('admin')))
    <li {!! (Request::is( 'call/*') || Request::is( 'call') ? 'class="active"' : '') !!}>
        <a href="{{url('call')}}">
            <span class="nav-icon">
         <i class="material-icons ">phone</i>
        </span>
            <span class="nav-text">{{trans('left_menu.calls')}}</span>
        </a>
    </li>
    @endif @if(isset($user_data) && ($user_data->hasAccess(['sales_orders.read']) || $user_data->inRole('admin')))
    <li {!! (Request::is( 'sales_order/*') || Request::is( 'sales_order') || Request::is('salesorder_delete_list') || Request::is('salesorder_invoice_list') ? 'class="active"' : '') !!}>
        <a href="{{url('sales_order')}}">
            <span class="nav-icon">
         <i class="material-icons ">attach_money</i>
        </span>
            <span class="nav-text">{{trans('left_menu.sales_order')}}</span>
        </a>
    </li>
    @endif @if(isset($user_data) && ($user_data->hasAccess(['products.read']) || $user_data->inRole('admin')))
    <li {!! (Request::is( 'product/*') || Request::is( 'product') || Request::is( 'category/*') || Request::is( 'category') ? 'class="active"' : '') !!}>
        <a>
            <span class="nav-caret pull-right">
            <i class="fa fa-angle-right"></i>
        </span>
            <span class="nav-icon"><i class="material-icons ">shopping_basket</i></span>
            <span class="nav-text">{{trans('left_menu.products')}}</span>
        </a>
        <ul class="nav-sub">
            <li {!! (Request::is( 'product/*') || Request::is( 'product') ? 'class="active"' : '') !!}>
                <a href="{{url('product')}}">
                    <i class="material-icons">layers</i>
                    <span class="nav-text">{{trans('left_menu.products')}}</span></a>
            </li>
            <li {!! (Request::is( 'category/*') || Request::is( 'category') ? 'class="active"' : '') !!}>
                <a href="{{url('category')}}">
                    <i class="material-icons">gamepad</i>
                    <span class="nav-text">{{trans('left_menu.category')}}</span></a>
            </li>
        </ul>
    </li>
    @endif
    <li {!! (Request::is( 'calendar/*') || Request::is( 'calendar') ? 'class="active"' : '') !!}>
        <a href="{{url('calendar')}}">
            <span class="nav-icon">
        <i class="material-icons">event_note</i>
        </span>
            <span class="nav-text">{{trans('left_menu.calendar')}}</span>
        </a>
    </li>
    @if(isset($user_data) && ($user_data->hasAccess(['contacts.read']) || $user_data->inRole('admin')))
    <li {!! (Request::is( 'customer/*') || Request::is( 'customer') || Request::is( 'company/*') || Request::is( 'company') ? 'class="active"' : '') !!}>
        <a>
            <span class="nav-caret pull-right">
          <i class="fa fa-angle-right"></i>
        </span>
            <span class="nav-icon">
           <i class="material-icons">person_pin</i>
        </span>
            <span class="nav-text">{{trans('left_menu.companies')}}</span>
        </a>
        <ul class="nav-sub">
            <li {!! (Request::is( 'company/*') || Request::is( 'company') ? 'class="active"' : '') !!}>
                <a href="{{url('company')}}">
                    <i class="material-icons ">flag</i>
                    <span class="nav-text">{{trans('left_menu.company')}}</span></a>
            </li>
            <li {!! (Request::is( 'customer/*') || Request::is( 'customer') ? 'class="active"' : '') !!}>
                <a href="{{url('customer')}}">
                    <i class="material-icons ">person</i>
                    <span class="nav-text">{{trans('left_menu.agent')}}</span></a>
            </li>
        </ul>
    </li>
    @endif

    @if(isset($user_data) && ($user_data->hasAccess(['meetings.read']) || $user_data->inRole('admin')))
    <li {!! (Request::is( 'meeting/*') || Request::is( 'meeting') ? 'class="active"' : '') !!}>
        <a href="{{url('meeting')}}">
            <span class="nav-icon">
         <i class="material-icons">radio</i>
        </span>
            <span class="nav-text">{{trans('left_menu.meetings')}}</span>
        </a>
    </li>
    @endif



    @if(isset($user_data) && $user_data->inRole('admin'))
    <li {!! (Request::is( 'option/*') || Request::is( 'option') ? 'class="active"' : '') !!}>
        <a href="{{url('option')}}">
            <span class="nav-icon">
     <i class="material-icons">dashboard</i>
    </span>
            <span class="nav-text">{{trans('left_menu.options')}}</span>
        </a>
    </li>
    <li {!! (Request::is( 'email_template/*') || Request::is( 'email_template') ? 'class="active"' : '') !!}>
        <a href="{{url('email_template')}}">
            <span class="nav-icon">
     <i class="material-icons">email</i>
    </span>
            <span class="nav-text">{{trans('left_menu.email_template')}}</span>
        </a>
    </li>
    <li {!! (Request::is( 'qtemplate/*') || Request::is( 'qtemplate') ? 'class="active"' : '') !!}>
        <a href="{{url('qtemplate')}}">
            <i class="material-icons ">image</i>
            <span class="nav-text">{{trans('left_menu.quotation_template')}}</span></a>
    </li>


    <li {!! (Request::is( 'setting/*') || Request::is( 'setting') ? 'class="active"' : '') !!}>
        <a href="{{url('setting')}}">
            <span class="nav-icon">
     <i class="material-icons">settings</i>
    </span>
            <span class="nav-text">{{trans('left_menu.settings')}}</span>
        </a>
    </li>



        <li {!! (Request::is( 'backup/*') || Request::is( 'backup') ? 'class="active"' : '') !!}>
            <a href="{{url('backup')}}">
				<span class="nav-icon">
					<i class="material-icons text-primary">backup</i>
				</span>
                <span class="nav-text">{{trans('left_menu.backup')}}</span>
            </a>
        </li>
    @endif
</ul>--}}
