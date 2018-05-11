  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="http://localhost/lsapp/public/">{{config("app.name", "LSAPP")}}</a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="http://localhost/lsapp/public/">Home <span class="sr-only">(current)</span></a>
            </li>
            <!--
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/lsapp/public/about">À Propos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/lsapp/public/services">Services</a>
            </li>-->
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/lsapp/public/posts">BARS</a>
            </li>
          </ul>
          <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <a class="nav-link" href="{{ route('login') }}"><span class="mr-sm-2"> Login</a>
                    <a class="nav-link" href="{{ route('register') }}"><span class="mr-sm-0"> Inscrivez-vous</a>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="btn btn-primary">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="http://localhost/lsapp/public/dashboard">Dashboard</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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