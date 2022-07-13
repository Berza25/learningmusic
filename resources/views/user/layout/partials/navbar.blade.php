<nav id="navbar" class="navbar">
    <ul>
        <li><a class="nav-link scrollto" href="/home">Home</a></li>
        @if (Route::has('login'))
            @auth
                @if (auth()->user()->role == 'admin')
                    <li><a class="nav-link scrollto" href="/dashboard">Dashboard</a></li>
                @endif
            @endauth
        @endif
        <li><a class="nav-link scrollto" href="/courses">Courses</a></li>
        <li><a class="nav-link scrollto" href="/mycourse">My Course</a></li>
        <li class="nav-item scrollto">
            <a class="nav-link" href="{{ route('cart.index') }}">
              <i class="fas fa-shopping-cart"></i>
              <span class="badge badge-danger"></span>
            </a>
        </li>
        @if (Route::has('login'))
                @auth
                <li>
                    <a class="getstarted scrollto" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </a>
                </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="nav-link scrollto">Log in</a>
                    </li>
                    @if (Route::has('register'))
                    <li>
                        <a href="{{ route('register') }}" class="nav-link scrollto">Register</a>
                    </li>
                    @endif
                @endauth
        @endif
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
</nav><!-- .navbar -->
