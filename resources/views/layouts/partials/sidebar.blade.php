    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a href="/dashboard" class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item  {{ request()->segment(2) == 'course' || request()->segment(2) == 'price' || request()->segment(2) == 'level' || request()->segment(2) == 'lesson' ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Course
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item ">
                        <a href="{{ route('price.index') }}"
                            class="nav-link {{ request()->segment(2) == 'price' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Price</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('level.index') }}" class="nav-link {{ request()->segment(2) == 'level' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Level</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('course.index') }}" class="nav-link {{ request()->segment(2) == 'course' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Course</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('lesson.index') }}" class="nav-link {{ request()->segment(2) == 'lesson' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Lesson</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link {{ request()->segment(2) == 'users' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Users
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
      <!-- /.sidebar-menu -->
