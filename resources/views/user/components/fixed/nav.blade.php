<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> contact@electro.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="{{url('/')}}" class="logo">
                            <img src="{{asset('assets/img/logo.png')}}" alt="Logo">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->
                <div class="col-md-6"></div>

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">

                        @include('user.components.products.cart_preview')

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                @foreach($menu as $link)
                <li><a href="{{url($link['route'])}}">{{$link['name']}}</a></li>
                @endforeach
                <li><a href="{{asset('dokumentacija.pdf')}}">Documentation</a></li>
                @if(session()->has('user'))
                    @if(session()->get('user')->role_id == 2)
                        <li><a href="{{url('/contact')}}">Contact</a></li>
                        <li><a href="{{url('/profile')}}"><i class="fa fa-user-o"></i> My Account</a></li>
                        <li><a href="{{ route("logout") }}">Logout</a></li>
                    @endif
                    @if(session()->get('user')->role_id == 1)
                            <li><a href="{{ url('/admin') }}">Admin panel</a></li>
                            <li><a href="{{ url("/admin/logout") }}">Logout</a></li>
                    @endif
                @else
                    <li><a href="{{ url('/login') }}"><i class="fa fa-user-o"></i> Login/Register</a></li>
                @endif
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->
