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
                <li>
                    <a href="">Contact</a>
                </li>
            </ul>

            <form class="navbar-form navbar-left" action="">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="search">
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
                                <a href=""><i class="glyphicon glyphicon-user"></i> Profile</a>
                            </li>
                            <li>
                                <a href=""><i class="glyphicon glyphicon-wrench"></i> Settings</a>
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
                <li>
                    <a href=""><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>