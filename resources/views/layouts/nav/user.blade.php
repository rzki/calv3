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

</ul>
