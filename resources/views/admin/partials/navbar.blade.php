<nav class="main-header fixed-top navbar navbar-expand navbar-white navbar-light" >
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Left navbar -->
    <ul class="navbar-nav mr-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu px-3">
                <a class="dropdown-item text-center" href="{{ route('password.change.form') }}" style="font-weight: bold">
                    <i class="bi bi-key pr-2"></i> {{ __('Change Password') }}
                </a>

                {{-- <a href="{{ route('password.change') }}"></a> --}}
                <a class="dropdown-item text-center text-danger" href="{{ route('logout') }}" style="font-weight: bold;"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right pr-2"></i> {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>



    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
