<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 100%; position: fixed; top:0%; left:0%;">
    {{-- <a href="{{ route('admin-dashboard') }}" class="brand-link">
        <div class="brand-image img-circle elevation-3">
            <i class="fas fa-user"></i>
        </div>
        <span class="p-3 brand-text font-weight-bold">{{ auth()->user()->name }}</span>
    </a> --}}


    <a href="{{ route('admin-dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light ml-3" style="font-weight: bold">ADMIN</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin-dashboard') }}"
                        class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">AKSI</li>
                <li class="nav-item">
                    <a href="{{ route('user-list') }}" class="nav-link {{ Request::is('user/*') ? 'active' : '' }}">
                        <i class="fas fa-users nav-icon"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kursus-list') }}" class="nav-link {{ Request::is('kursus/*') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher nav-icon"></i>
                        <p>Kursus</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('materi-list') }}" class="nav-link {{ Request::is('materi/*') ? 'active' : '' }}">
                        <i class="fas fa-video nav-icon"></i>
                        <p>Materi</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
