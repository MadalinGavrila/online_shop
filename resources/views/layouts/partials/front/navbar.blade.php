<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('home')}}">Shop</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{Request::is('contact') ? 'active' : ''}}">
                    <a href="{{route('home.contact')}}">Contact</a>
                </li>
            </ul>

            <form class="navbar-form navbar-left" action="{{route('home.search')}}" method="GET">
                <div class="form-group {{$errors->has('search') ? 'has-error has-feedback' : ''}}">
                    <input type="text" class="form-control" placeholder="{{$errors->has('search') ? $errors->first('search') : 'Search'}}" name="search">
                    @if($errors->has('search'))
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>

            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li class="{{Request::is('login') ? 'active' : ''}}">
                        <a href="{{route('login')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                    </li>
                    <li class="{{Request::is('register') ? 'active' : ''}}">
                        <a href="{{route('register')}}"><span class="glyphicon glyphicon-user"></span> Register</a>
                    </li>
                @else
                    @role('admin')
                        <li>
                            <a href="{{route('admin')}}">Admin Panel</a>
                        </li>
                    @endrole
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> {{Auth::user()->full_name}} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('account')}}"><i class="glyphicon glyphicon-user"></i> Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="glyphicon glyphicon-off"></span> Log Out</a>
                            </li>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endguest
                <li class="{{Request::is('cart') ? 'active' : ''}}">
                    <a href="{{route('cart')}}"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge">{{$cart->itemCount()}}</span></a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>