<div>
    <div class="py-4 main">
        <div class="row mb-3">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold">{{ __('Dashboard') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-3 mb-3">
                <div class="px-0">
                    <div class="border-0 shadow card">
                        <a href="{{ route('hospitals.index') }}" wire:navigate>
                            <div class="card-body">
                                <h2 class="mb-4 fs-5 fw-bold text-center">{{ __('Rumah Sakit') }}</h2>
                                <h3 class="text-center">{{ $dashboardRS }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="px-0">
                    <div class="border-0 shadow card">
                        <a href="{{ route('devices.index') }}" wire:navigate>
                            <div class="card-body">
                                <h2 class="mb-4 fs-5 fw-bold text-center">{{ __('Alat') }}</h2>
                                <h3 class="text-center">{{ $dashboardAlat }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="px-0">
                    <div class="border-0 shadow card">
                        <a href="{{ route('inventories.index') }}" wire:navigate>
                            <div class="card-body">
                                <h2 class="mb-4 fs-5 fw-bold text-center">{{ __('Inventaris') }}</h2>
                                <h3 class="text-center">{{ $dashboardInventory }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="px-0">
                    <div class="border-0 shadow card">
                        <a href="{{ route('logbooks.index') }}" wire:navigate>
                            <div class="card-body">
                                <h2 class="mb-4 fs-5 fw-bold text-center">{{ __('Log Book') }}</h2>
                                <h3 class="text-center">{{ $dashboardLogBook }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
