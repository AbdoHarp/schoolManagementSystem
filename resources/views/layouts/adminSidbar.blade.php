<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src={{ asset('dist/img/school.jpeg') }} alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">SchoolMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src={{ asset('dist/img/user2-160x160.jpg') }} class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (Auth::user()->user_utype == 1)
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <span class="badge badge-info right"></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/admin/list') }}"
                            class="nav-link @if (Request::segment(2) == 'admin') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Admin
                            </p>
                        </a>
                    <li>
                    @elseif (Auth::user()->user_utype == 2)
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <span class="badge badge-info right"></span>
                            </p>
                        </a>
                    </li>
                @elseif (Auth::user()->user_utype == 3)
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <span class="badge badge-info right"></span>
                            </p>
                        </a>
                    </li>
                @elseif (Auth::user()->user_utype == 4)
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <span class="badge badge-info right"></span>
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ url('/logout') }}" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                <li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
