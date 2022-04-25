      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Course
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/price" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Price</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/level" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('course.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Course</p>
                </a>
              </li>
            </ul>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
