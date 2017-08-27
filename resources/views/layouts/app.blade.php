<!DOCTYPE html>
<html lang="{{app()->getLocale() }}">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{csrf_token() }}" />

	<title>{{config('app.name', 'Warehouse') }}</title>

	<!-- Styles -->
	<link href="{{asset('css/app.css') }}" rel="stylesheet" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
	<link href="{{asset('css/style.css') }}" rel="stylesheet" />
	<script>
    	function attachToWinLoad(closure) {
    		if (window.addEventListener) {// W3C standard
    			window.addEventListener('load', closure, false); // NB **not** 'onload'
    		}
    		else if (window.attachEvent) {// Microsoft
    			window.attachEvent('onload', closure);
    		}
    	}
	</script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Warehouse
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @if ($errors->any())
            <div class="row">
                <div class="col-md-12 no-padding-right">
                    <div class="alert alert-danger">
                        {{ implode('\xA', $errors->all(':message')) }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked panel panel-default">
                    <li class="{{RouteHelper::isActiveRoute('home') }}">
                        <a href="{{url('home')}}">
                            <i class="fa fa-home fa-fw"></i>Home
                        </a>
                    </li>
                    @if(request()->user()->HasRole('admin'))
                    <li class="{{RouteHelper::areActiveRoutes(['users.index', 'users.create', 'users.show', 'users.shops']) }}">
                        <a href="{{url('/users')}}">
                            <i class="fa fa-list-alt fa-fw"></i>Users
                        </a>
                    </li>
                    <li class="{{RouteHelper::areActiveRoutes(['shops.index', 'shops.create', 'shops.show']) }}">
                        <a href="{{url('shops')}}">
                            <i class="fa fa-file-o fa-fw"></i>Shops
                        </a>
                    </li>
                    @endif
                    <li class="{{RouteHelper::areActiveRoutes(['devices.index', 'devices.create', 'devices.show']) }}">
                        <a href="{{url('devices')}}">
                            <i class="fa fa-cogs fa-fw"></i>Devices
                        </a>
                    </li>
                    <li class="{{RouteHelper::areActiveRoutes(['orders.index', 'orders.create', 'orders.show']) }}">
                        <a href="{{url('orders')}}">
                            <i class="fa fa-file-text-o fa-fw"></i>Orders
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>
</div>

    <!-- Scripts -->
    <script src="{{asset('js/app.js') }}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js"
            integrity="sha256-55Jz3pBCF8z9jBO1qQ7cIf0L+neuPTD1u7Ytzrp2dqo="
            crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

    <script src="{{asset('js/script.js') }}"></script>
    @yield('scripts')
</body>
</html>
