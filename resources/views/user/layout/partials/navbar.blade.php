<nav id="navbar" class="navbar">
    <ul>
        <li><a class="nav-link scrollto" href="/">Home</a></li>
        <li><a class="nav-link scrollto" href="/courses">Courses</a></li>
        @if (Route::has('login'))
            @auth
                @if (auth()->user()->role == 'admin')
                    <li><a class="nav-link scrollto" href="/dashboard">Dashboard</a></li>
                @endif
            @endauth
            @auth
            <li><a class="nav-link scrollto" href="/mycourse">My Course</a></li>
            <li class="nav-item scrollto">
                <a class="nav-link" href="{{ route('cart.index') }}">
                    <i class="bi bi-cart3">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $daftarCart->where('user_id', auth()->user()->id)->count() }}</span>
                    </i>
                </a>
            </li>
            <li class="dropdown">
                <a href="#">
                    <span>
                        @if (auth()->user()->foto != null)
                        <img class="rounded-circle shadow-1-strong border-2 border border-primary" src="{{ asset('images/users/'. auth()->user()->foto) }}" alt="avatar" width="30" height="30" />
                        @else
                        <img class="rounded-circle shadow-1-strong border border-2 border-primary" src="{{ asset('images.png') }}" alt="avatar" width="30" height="30" />
                        @endif
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </a>
                <ul>
                    <li><a href="{{ route('profileuser') }}">Account</a></li>
                    <li><a href="{{ route('order.index') }}">Order Menu</a></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>
                </ul>
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
