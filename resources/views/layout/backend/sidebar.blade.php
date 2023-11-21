<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->

    @if(Auth::user()->role == 'admin')
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
        <div class="sidebar-brand-icon">
            <i class="fab fa-laravel"></i>
        </div>
        <div class="sidebar-brand-text mx-3">IF SMART</div>
    </a>
    @elseif(Auth::user()->role == 'mahasiswa')
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('user') }}">
        <div class="sidebar-brand-icon">
            <i class="fab fa-laravel"></i>
        </div>
        <div class="sidebar-brand-text mx-3">IF SMART</div>
    </a>
    @elseif(Auth::user()->role == 'dosen')
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dosen') }}">
        <div class="sidebar-brand-icon">
            <i class="fab fa-laravel"></i>
        </div>
        <div class="sidebar-brand-text mx-3">IF SMART</div>
    </a>
    @elseif(Auth::user()->role == 'departemen')
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('departemen') }}">
        <div class="sidebar-brand-icon">
            <i class="fab fa-laravel"></i>
        </div>
        <div class="sidebar-brand-text mx-3">IF SMART</div>
    </a>
    @endif


    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @if(Auth::user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @elseif(Auth::user()->role == 'mahasiswa')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fa-solid fa-gauge"></i>
            <span>Dashboard</span></a>
    </li>
    @elseif(Auth::user()->role == 'dosen')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dosen') }}">
            <i class="fa-solid fa-gauge"></i>
            <span>Dashboard</span></a>
    </li>
    @elseif(Auth::user()->role == 'departemen')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('departemen') }}">
            <i class="fa-solid fa-gauge"></i>
            <span>Dashboard</span></a>
    </li>
    @endif



    @can('admin')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            <i class="fas fa-fw fa-table"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('user.index') }}">Mahasiswa</a>
                {{-- <a class="collapse-item" href="{{ route('manajemen-user') }}">Mahasiswa</a> --}}
            </div>
        </div>
    </li>
    @endcan

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="{{ route('buttons') }}">Buttons</a>
                <a class="collapse-item" href="{{ route('cards') }}">Cards</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Utilities Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="{{ route('utilities-colors') }}">Colors</a>
                <a class="collapse-item" href="{{ route('utilities-borders') }}">Borders</a>
                <a class="collapse-item" href="{{ route('utilities-animations') }}">Animations</a>
                <a class="collapse-item" href="{{ route('utilities-other') }}">Other</a>
            </div>
        </div>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    {{-- @if(Auth::user()->role == 'dosen')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('irs.index') }}">
            <i class="fa-solid fa-pen-to-square"></i>
            <span>Verifikasi IRS</span></a>
    </li>
    @endif --}}

    <!-- Nav Item - Utilities Collapse Menu -->
    @if(Auth::user()->role == 'dosen')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            {{-- <i class="fas fa-fw fa-wrench"></i> --}}
            <i class="fa-solid fa-pen-to-square"></i>
            <span>Verifikasi</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Utilities:</h6> --}}
                <a class="collapse-item" href="{{ route('irs.index') }}">Verifikasi IRS</a>
                <a class="collapse-item" href="{{ route('khs.index') }}">Verifikasi KHS </a>
                <a class="collapse-item" href="{{ route('pkl.index') }}">Verifikasi PKL</a>
                <a class="collapse-item" href="{{ route('skripsi.index') }}">Verifikasi Skripsi</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('listmahasiswa') }}">
            <i class="fa-solid fa-pen-to-square"></i>
            <span>List Mahasiswa</span></a>
    </li>
    @endif

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Addons
    </div> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
        aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="{{ route('login') }}">Login</a>
                <a class="collapse-item" href="{{ route('register') }}">Register</a>
                <a class="collapse-item" href="{{ route('forgot-password') }}">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="{{ route('404-page') }}">404 Page</a>
                <a class="collapse-item" href="{{ route('blank-page') }}">Blank Page</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('chart') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> --}}

    <!-- Nav Item - Tables -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('tables') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> --}}



    @if(Auth::user()->role == 'mahasiswa')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('irs') }}">
            <i class="fa-solid fa-pen-to-square"></i>
            <span>IRS</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('khs') }}">
            <i class="fa-solid fa-chart-bar"></i>
            <span>KHS</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pkl') }}">
            <i class="fa-solid fa-book-open"></i>
            <span>PKL</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('skripsi') }}">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Skripsi</span></a>
    </li>
    @endif

    @if(Auth::user()->role == 'mahasiswa')
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
    </li>
    @elseif(Auth::user()->role == 'departemen')
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profiledept') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
    </li>
    @endif



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">



    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
