<ul class="pt-3 nav flex-column pt-md-0">
    <li class="nav-item">
        <a href="{{ route('home') }}" class="justify-content-center nav-link d-flex align-items-center">
            {{-- <span class="sidebar-icon me-3">
                <img src="{{ asset('images/brand/light.svg') }}" height="20" width="20" alt="Volt Logo">
            </span> --}}
            <h4 class="mt-1 ms-1 text-uppercase">
                Kalibrasi
            </h4>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="nav-link">
            <span class="sidebar-icon me-3">
                <i class="fa fa-home" aria-hidden="true"></i>
            </span>
            <span class="sidebar-text">{{ __('Dashboard') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <span class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
            data-bs-target="#inventory-dropdown">
            <span>
                <span class="sidebar-icon me-3">
                    <i class="fas fa-boxes"></i>
                </span>
                <span class="sidebar-text">{{ __('Inventaris') }}</span>
            </span>
            <span class="link-arrow">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </span>
        </span>
        <div class="multi-level collapse" role="list" id="inventory-dropdown" aria-expanded="false">
            <ul class="flex-column nav">
                <li class="nav-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        {{-- <span class="sidebar-icon me-3">
                        <i class="fas fa-circle"></i>
                    </span> --}}
                        <span class="sidebar-text">{{ __('Semua Inventaris') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <span class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
            data-bs-target="#device-dropdown">
            <span>
                <span class="sidebar-icon me-3">
                    <i class="fas fa-screwdriver" aria-hidden="true"></i>
                </span>
                <span class="sidebar-text">{{ __('Alat') }}</span>
            </span>
            <span class="link-arrow">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </span>
        </span>
        <div class="multi-level collapse" role="list" id="device-dropdown" aria-expanded="false">
            <ul class="flex-column nav">
                <li class="nav-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        {{-- <span class="sidebar-icon me-3">
                            <i class="fas fa-circle"></i>
                        </span> --}}
                        <span class="sidebar-text">{{ __('Semua Alat') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="nav-link">
            <span class="sidebar-icon me-3">
                <i class="fas fa-hospital" aria-hidden="true"></i>
            </span>
            <span class="sidebar-text">{{ __('Rumah Sakit') }}</span>
        </a>
    </li>
</ul>
