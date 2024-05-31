<ul class="pt-3 nav flex-column pt-md-0">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="justify-content-center nav-link d-flex align-items-center" wire:navigate>

            <h4 class="mt-1 ms-1 text-uppercase">
                Kalibrasi
            </h4>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link" wire:navigate>
            <span class="sidebar-icon me-3">
                <i class="fa fa-home" aria-hidden="true"></i>
            </span>
            <span class="sidebar-text">{{ __('Dashboard') }}</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('inventory.index') ? 'active' : '' }}">
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
                <li class="nav-item {{ request()->routeIs('inventories.index') ? 'active' : '' }}">
                    <a href="{{ route('inventories.index') }}" class="nav-link" wire:navigate>
                        <span class="sidebar-text">{{ __('Semua Inventaris') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item {{ request()->routeIs('logbooks.index') ? 'active' : '' }}">
        <a href="{{ route('logbooks.index') }}" class="nav-link" wire:navigate>
            <span class="sidebar-icon me-3">
                <i class="fas fa-book" aria-hidden="true"></i>
            </span>
            <span class="sidebar-text">{{ __('Log Book') }}</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('devices.index') || request()->routeIs('device_name.index')  ? 'active' : '' }}">
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
                <li class="nav-item {{ request()->routeIs('devices.index') ? 'active' : '' }}">
                    <a href="{{ route('devices.index') }}" class="nav-link" wire:navigate>
                        <span class="sidebar-text">{{ __('QR Alat') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('device_name.index') ? 'active' : '' }}">
                    <a href="{{ route('device_name.index') }}" class="nav-link" wire:navigate>
                        <span class="sidebar-text">{{ __('Nama Alat') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item {{ request()->routeIs('hospitals.index') ? 'active' : '' }}">
        <a href="{{ route('hospitals.index') }}" class="nav-link" wire:navigate>
            <span class="sidebar-icon me-3">
                <i class="fas fa-hospital" aria-hidden="true"></i>
            </span>
            <span class="sidebar-text">{{ __('Rumah Sakit') }}</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('roles.index') ? 'active' : '' }}">
        <a href="{{ route('roles.index') }}" class="nav-link" wire:navigate>
            <span class="sidebar-icon me-2">
                <i class="fas fa-user-gear" aria-hidden="true"></i>
            </span>
            <span class="sidebar-text">{{ __('Roles') }}</span>
        </a>
    </li>
</ul>
