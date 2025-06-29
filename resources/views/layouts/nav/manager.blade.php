<ul class="pt-3 nav flex-column pt-md-0">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="justify-content-center nav-link d-flex align-items-center"
            wire:navigate>

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

    @if (auth()->user()->hasRole('User'))
        {{-- Inventaris --}}
        <li
            class="nav-item {{ request()->routeIs('inventories.index') || request()->routeIs('inventories.create') || request()->routeIs('inventories.edit') || request()->routeIs('inventories.detail') || request()->routeIs('inventories.add_log') || request()->routeIs('inventories.edit_log') ? 'active' : '' }}">
            <a href="{{ route('inventories.index') }}" class="nav-link" wire:navigate>
                <span class="sidebar-icon me-3">
                    <i class="fas fa-boxes" aria-hidden="true"></i>
                </span>
                <span class="sidebar-text">{{ __('Inventaris') }}</span>
            </a>
        </li>
        {{-- RS --}}
        <li
            class="nav-item {{ request()->routeIs('hospitals.index') || request()->routeIs('hospitals.create') || request()->routeIs('hospitals.edit') || request()->routeIs('hospitals.detail') || request()->routeIs('hospitals.add_device') || request()->routeIs('hospitals.index') ? 'active' : '' }}">
            <a href="{{ route('hospitals.index') }}" class="nav-link" wire:navigate>
                <span class="sidebar-icon me-3">
                    <i class="fas fa-hospital" aria-hidden="true"></i>
                </span>
                <span class="sidebar-text">{{ __('Data Pelanggan') }}</span>
            </a>
        </li>
    @endif

    @if (auth()->user()->hasRole('Teknisi'))
        {{-- Inventaris --}}
        <li
            class="nav-item {{ request()->routeIs('inventories.index') || request()->routeIs('inventories.create') || request()->routeIs('inventories.edit') || request()->routeIs('inventories.detail') || request()->routeIs('inventories.add_log') || request()->routeIs('inventories.edit_log') ? 'active' : '' }}">
            <a href="{{ route('inventories.index') }}" class="nav-link" wire:navigate>
                <span class="sidebar-icon me-3">
                    <i class="fas fa-boxes" aria-hidden="true"></i>
                </span>
                <span class="sidebar-text">{{ __('Inventaris') }}</span>
            </a>
        </li>
        {{-- Log Book --}}
        <li class="nav-item {{ request()->routeIs('logbooks.index') ? 'active' : '' }}">
            <a href="{{ route('logbooks.index') }}" class="nav-link" wire:navigate>
                <span class="sidebar-icon me-3">
                    <i class="fas fa-book" aria-hidden="true"></i>
                </span>
                <span class="sidebar-text">{{ __('Log Book') }}</span>
            </a>
        </li>
        {{-- Alat --}}
        <li
            class="nav-item {{ request()->routeIs('devices.index') || request()->routeIs('devices.generate') || request()->routeIs('devices.edit') || request()->routeIs('device_name.index') || request()->routeIs('device_name.create') || request()->routeIs('device_name.edit') ? 'active' : '' }}">
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
                    <li
                        class="nav-item {{ request()->routeIs('devices.index') || request()->routeIs('devices.generate') || request()->routeIs('devices.edit') ? 'active' : '' }}">
                        <a href="{{ route('devices.index') }}" class="nav-link" wire:navigate>
                            <span class="sidebar-text">{{ __('QR Alat') }}</span>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('device_name.index') || request()->routeIs('device_name.create') || request()->routeIs('device_name.edit') ? 'active' : '' }}">
                        <a href="{{ route('device_name.index') }}" class="nav-link" wire:navigate>
                            <span class="sidebar-text">{{ __('Nama Alat') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- RS --}}
        <li
            class="nav-item {{ request()->routeIs('hospitals.index') || request()->routeIs('hospitals.create') || request()->routeIs('hospitals.edit') || request()->routeIs('hospitals.detail') || request()->routeIs('hospitals.add_device') || request()->routeIs('hospitals.index') ? 'active' : '' }}">
            <a href="{{ route('hospitals.index') }}" class="nav-link" wire:navigate>
                <span class="sidebar-icon me-3">
                    <i class="fas fa-hospital" aria-hidden="true"></i>
                </span>
                <span class="sidebar-text">{{ __('Data Pelanggan') }}</span>
            </a>
        </li>
    @endif

    @if (!auth()->user()->hasRole('User') || !auth()->user()->hasRole('Teknisi'))
        {{-- Inventaris --}}
        <li
            class="nav-item {{ request()->routeIs('inventories.index') || request()->routeIs('inventories.create') || request()->routeIs('inventories.edit') || request()->routeIs('inventories.detail') || request()->routeIs('inventories.add_log') || request()->routeIs('inventories.edit_log') ? 'active' : '' }}">
            <a href="{{ route('inventories.index') }}" class="nav-link" wire:navigate>
                <span class="sidebar-icon me-3">
                    <i class="fas fa-boxes" aria-hidden="true"></i>
                </span>
                <span class="sidebar-text">{{ __('Inventaris') }}</span>
            </a>
        </li>
        {{-- Log Book --}}
        <li class="nav-item {{ request()->routeIs('logbooks.index') ? 'active' : '' }}">
            <a href="{{ route('logbooks.index') }}" class="nav-link" wire:navigate>
                <span class="sidebar-icon me-3">
                    <i class="fas fa-book" aria-hidden="true"></i>
                </span>
                <span class="sidebar-text">{{ __('Log Book') }}</span>
            </a>
        </li>
        {{-- Alat --}}
        <li class="nav-item {{ request()->routeIs('devices.index') || request()->routeIs('devices.generate') || request()->routeIs('devices.edit') || request()->routeIs('device_name.index') || request()->routeIs('device_name.create') || request()->routeIs('device_name.edit') ? 'active' : '' }}">
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
                    <li
                        class="nav-item {{ request()->routeIs('devices.index') || request()->routeIs('devices.generate') || request()->routeIs('devices.edit') ? 'active' : '' }}">
                        <a href="{{ route('devices.index') }}" class="nav-link" wire:navigate>
                            <span class="sidebar-text">{{ __('QR Alat') }}</span>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('device_name.index') || request()->routeIs('device_name.create') || request()->routeIs('device_name.edit') ? 'active' : '' }}">
                        <a href="{{ route('device_name.index') }}" class="nav-link" wire:navigate>
                            <span class="sidebar-text">{{ __('Nama Alat') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- RS --}}
        <li
            class="nav-item {{ request()->routeIs('hospitals.index') || request()->routeIs('hospitals.create') || request()->routeIs('hospitals.edit') || request()->routeIs('hospitals.detail') || request()->routeIs('hospitals.add_device') || request()->routeIs('hospitals.index') ? 'active' : '' }}">
            <a href="{{ route('hospitals.index') }}" class="nav-link" wire:navigate>
                <span class="sidebar-icon me-3">
                    <i class="fas fa-hospital" aria-hidden="true"></i>
                </span>
                <span class="sidebar-text">{{ __('Data Pelanggan') }}</span>
            </a>
        </li>
    @endif
</ul>
