<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-2 pt-3">
        @include('layouts.responsive-topbar')
        {{-- @if (Auth::user()->hasRole('Superadmin') || Auth::user()->hasRole('Admin'))
            @include('layouts.nav.superadmin')
        @elseif (Auth::user()->hasRole('Manager'))
            @include('layouts.nav.manager')
        @elseif (Auth::user()->hasRole('Teknisi'))
            @include('layouts.nav.teknisi')
        @elseif (Auth::user()->hasRole('User'))
            @include('layouts.nav.user')
        @endif --}}
        @include('layouts.navbar')
    </div>
</nav>
