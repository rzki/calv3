<nav class="pb-0 navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2">
    <div class="px-0 container-fluid">
        <div class="d-flex justify-content-end w-100" id="navbarSupportedContent">
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown ms-lg-3">
                    <a class="px-0 pt-1 nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <img class="avatar rounded-circle"
                                src="https://ui-avatars.com/api/?background=random&name={{ Auth::user()->name }}"
                                alt="{{ Auth::user()->name }}">
                            <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                <span class="mb-0 text-gray-900 font-small fw-bold">{{ auth()->user()->name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="py-1 mt-2 dropdown-menu dashboard-dropdown dropdown-menu-end">
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profiles.show') }}" wire:navigate><i class="fas fa-circle-user dropdown-icon me-2"></i>
                            {{ __('Profil Saya') }}
                        </a>
                        <div role="separator" class="my-1 dropdown-divider"></div>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <form method="POST" id="logout-form">
                            </form>
                            <i class="fas fa-right-from-bracket dropdown-icon text-danger me-2"></i>
                            {{ __('Log Out') }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
