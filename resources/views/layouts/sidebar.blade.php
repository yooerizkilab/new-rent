<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Nav::isRoute('admin.home') }}">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>

    @role('administrator')
    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Management') }}
    </div>

    <!-- Nav Item - Mobil -->
    <li class="nav-item {{ Nav::isRoute('admin.cars') }}">
        <a class="nav-link" href="{{ route('admin.cars') }}">
            <i class="fas fa-fw fa-car"></i>
            <span>{{ __('Mobil') }}</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item {{ Nav::isRoute('admin.bookings*') }}">
        <a class="nav-link {{ request()->is('admin/bookings*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="{{ request()->is('admin/bookings*') ? 'true' : 'false' }}" aria-controls="collapseOne">
            <i class="fas fa-fw fa-file-pen"></i>
            <span>{{ __('Bookings') }}</span>
        </a>
        <div id="collapseOne" class="collapse {{ request()->is('admin/bookings*') ? 'show' : '' }}" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ __('Management Bookings') }}</h6>
                <a class="collapse-item" href="{{ route('admin.bookings.create') }}">{{ __('Form Booking') }}</a>
                <a class="collapse-item" href="{{ route('admin.bookings') }}">{{ __('Data Booking') }}</a>
            </div>
        </div>
    </li> --}}
    

    <!-- Nav Item - Transaksi -->
    {{-- <li class="nav-item {{ Nav::isRoute('admin.transactions') }}">
        <a class="nav-link" href="{{ route('admin.transactions') }}">
            <i class="fas fa-fw fa-shuffle"></i>
            <span>{{ __('Transaksi') }}</span>
        </a>
    </li> --}}

    <!-- Nav Item - Pelanggan -->
    {{-- <li class="nav-item {{ Nav::isRoute('admin.customers') }}">
        <a class="nav-link" href="{{ route('admin.customers') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>{{ __('Pelanggan') }}</span>
        </a>
    </li> --}}

    <!-- Nav Item - Drivers -->
    {{-- <li class="nav-item {{ Nav::isRoute('admin.drivers') }}">
        <a class="nav-link" href="{{ route('admin.drivers') }}">
            <i class="fas fa-fw fa-id-card-clip"></i>
            <span>{{ __('Drivers') }}</span>
        </a>
    </li> --}}

    <!-- Nav Item - Maintenance -->
    {{-- <li class="nav-item {{ Nav::isRoute('admin.maintenance') }}">
        <a class="nav-link" href="{{ route('admin.maintenance') }}">
            <i class="fas fa-fw fa-car-burst"></i>
            <span>{{ __('Maintenance') }}</span>
        </a>
    </li> --}}

    <!-- Nav Item - Promotions -->
    {{-- <li class="nav-item {{ Nav::isRoute('admin.promotions') }}">
        <a class="nav-link" href="{{ route('admin.promotions') }}">
            <i class="fas fa-fw fa-award"></i>
            <span>{{ __('Promosi') }}</span>
        </a>
    </li> --}}

    <!-- Nav Item - Laporan -->
    {{-- <li class="nav-item {{ Nav::isRoute('admin.reports') }}">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-file-arrow-down"></i>
            <span>{{ __('Laporan') }}</span>
        </a>
    </li> --}}

    @endrole
    
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Settings') }}
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Nav::isRoute('settings*') }}">
        <a class="nav-link {{ request()->is('settings*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="{{ request()->is('settings*') ? 'true' : 'false' }}" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users-gear"></i>
            <span>{{ __('Management Users') }}</span>
        </a>
        <div id="collapseTwo" class="collapse {{ request()->is('settings*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ __('Management Users') }}</h6>
                <a class="collapse-item" href="{{ route('settings.users') }}">{{ __('Users Management') }}</a>
                <a class="collapse-item" href="{{ route('settings.roles') }}">{{ __('Roles Management') }}</a>
                <a class="collapse-item" href="{{ route('settings.permissions') }}">{{ __('Permissions Management') }}</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTree" aria-expanded="" aria-controls="collapseTree">
            <i class="fas fa-fw fa-cogs"></i>
            <span>{{ __('General Settings') }}</span>
        </a>
        <div id="collapseTree" class="collapse" aria-labelledby="headingTree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ __('General Settings') }}</h6>
                <a class="collapse-item" href="">{{ __('Route Management') }}</a>
                <a class="collapse-item" href="">{{ __('Menu Management') }}</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Profile -->
    <li class="nav-item {{ Nav::isRoute('profile') }}">
        <a class="nav-link" href="{{ route('settings.profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Profile') }}</span>
        </a>
    </li>

    <!-- Nav Item - About -->
    <li class="nav-item {{ Nav::isRoute('about') }}">
        <a class="nav-link" href="{{ route('settings.about') }}">
            <i class="fas fa-fw fa-hands-helping"></i>
            <span>{{ __('About') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>