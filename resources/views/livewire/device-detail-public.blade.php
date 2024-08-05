<div>
    <div class="row vh-100 mx-0">
        <div class="col d-flex flex-column justify-content-center align-items-center">
            @if (Auth::user())
            <div class="row mb-5">
                <a href="{{ route('devices.index') }}" wire:navigate class="btn btn-primary"><i
                        class="fas fa-arrow-left"></i> {{ __('Kembali') }}</a>
            </div>
            @else
            <div class="row mb-5">
                <a href="{{ route('devices.list') }}" wire:navigate class="btn btn-primary"><i
                        class="fas fa-arrow-left"></i> {{ __('Kembali') }}</a>
            </div>
            @endif
            <div class="row mb-5">
                <img src="{{ asset('storage/' . $qr->barcode) }}" style="width:10em;" alt="">
            </div>
            <div class="row mb-3">
                <div class="col text-center">
                    <div class="name">
                        <h4 class="fw-bold">{{ __('Nama') }}</h4>
                        <p class="fs-5">{{ $qr->devNames->name ?? '' }}</p>
                    </div>
                    <div class="brand">
                        <h4 class="fw-bold">{{ __('Merk') }}</h4>
                        <p class="fs-5">{{ $qr->brand ?? '' }}</p>
                    </div>
                    <div class="type">
                        <h4 class="fw-bold">{{ __('Tipe') }}</h4>
                        <p class="fs-5">{{ $qr->type ?? '' }}</p>
                    </div>
                    <div class="last-calibration">
                        <h4 class="fw-bold">{{ __('Tanggal Kalibrasi') }}</h4>
                        @if ($qr->calibration_date == null)
                        <p class="fs-5">{{ '' }}</p>
                        @else
                        <p class="fs-5">{{ date('j F Y', strtotime($qr->calibration_date)) }}</p>
                        @endif
                    </div>
                </div>
                <div class="col text-center">
                    <div class="serial-number">
                        <h4 class="fw-bold">{{ __('S/N') }}</h4>
                        <p class="fs-5">{{ $qr->serial_number ?? '' }}</p>
                    </div>
                    <div class="location">
                        <h4 class="fw-bold">{{ __('Lokasi') }}</h4>
                        <p class="fs-5">{{ $qr->location ?? '' }}</p>
                    </div>
                    <div class="hospital">
                        <h4 class="fw-bold">{{ __('Rumah Sakit') }}</h4>
                        <p class="fs-5">{{ $qr->hospitals->name ?? '' }}</p>
                    </div>
                    <div class="next-calibration">
                        <h4 class="fw-bold">{{ __('Kalibrasi Selanjutnya') }}</h4>
                        @if ($qr->next_calibration_date == null)
                        <p class="fs-5">{{ '' }}</p>
                        @else
                        <p class="fs-5">{{ date('j F Y', strtotime($qr->next_calibration_date)) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mb-3 d-grid">
                <h4 class="fw-bold text-center">{{ __('Sertifikat') }}</h4>
                @if (Auth::guest())
                <a href="{{ route('devices.detail', $qr->deviceId) }}" class="btn btn-danger" target="_blank"><i
                        class="fas fa-up-right-from-square"></i>
                    {{ __('Login untuk melihat / mengunduh sertifikat') }}</a>
                <script>
                    sessionStorage.setItem('intended_url', route('devices.detail', $qr->deviceId));
                </script>
                @else
                <a href="{{ asset('storage/' . $qr->certif_file) }}" class="btn btn-primary" target="_blank"><i
                        class="fas fa-up-right-from-square"></i> {{ __('Lihat Sertifikat') }}</a>
                @endif
            </div>
            <div class="row text-center">
                <h4 class="fw-bold">{{ __('Status') }}</h4>
                <p>{{ $qr->status ?? '' }}</p>
            </div>
            <div class="row">
                @if (Auth::guest())
                <a href="{{ route('devices.detail', $qr->deviceId) }}" class="btn btn-danger btn-block w-100">{{ __('Masuk untuk mengubah data') }}</a>
                {{-- <a href="{{ route('login') }}" class="btn btn-info"><i class="fas fa-up-right-from-square"></i> {{ __('Lihat Sertifikat') }}</a> --}}
                <script>
                    sessionStorage.setItem('intended_url', route('devices.publicDetail', $qr->deviceId));
                </script>
                @elseif(Auth::check())
                <a href="{{ route('devices.edit', $qr->deviceId) }}" class="btn btn-success w-100">{{ __('Perbarui Data') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
