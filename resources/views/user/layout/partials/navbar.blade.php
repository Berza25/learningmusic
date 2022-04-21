<nav id="navbar" class="navbar">
    <ul>
      <li><a class="nav-link scrollto active" href="/home">Home</a></li>
      @if (auth()->user()->role=='admin')
      <li><a class="nav-link scrollto active" href="/dashboard">Dashboard</a></li>
      @endif
      <li><a class="nav-link scrollto" href="/courses">Courses</a></li>
      <li><a class="nav-link scrollto" href="#about">About</a></li>
    </ul>
    <ul>
      </li>
      <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
      <li><a class="getstarted scrollto" href="{{ route('logout') }}"
        onclick="event.preventDefault();
       document.getElementById('logout-form').submit();">
         {{ __('Logout') }}
         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
     </a></li>
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
  </nav><!-- .navbar -->