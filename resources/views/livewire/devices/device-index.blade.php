<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-3">{{ __('Semua Alat') }}</h2>
                            <div class="row mb-4">
                                <div class="col d-flex justify-content-end">
                                    @if (auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Teknisi'))
                                        <a href="{{ route('devices.generate') }}" wire:navigate
                                            class="btn btn-success text-white"><i class="fas fa-plus"></i>
                                            {{ __('Tambah Alat') }}</a>
                                    @endif
                                </div>
                            </div>
                            <div class="row filter">
                                <div class="col">
                                    <div class="d-flex mb-3">
                                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#filterDropdown" aria-expanded="false"
                                            aria-controls="filterDropdown">
                                            Filter
                                        </button>
                                    </div>
                                    <div class="collapse" id="filterDropdown">
                                        <div class="card card-body border-0">
                                            <div class="row">
                                                <div class="col-lg-4">

                                                </div>
                                                <div class="col-lg-4">
                                                    {{-- <form wire:submit='dateFilter' method="get"> --}}
                                                    <div class="row">
                                                        @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Teknisi'))
                                                            <div class="col-lg-6">
                                                                <p class="text-center mb-1">{{ __('Start') }}</p>
                                                                <input type="date" name="start-date" id="start-date"
                                                                    class="form-control"
                                                                    wire:model='start_date_admin'>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <p class="text-center mb-1">{{ __('End') }}</p>
                                                                <input type="date" name="end-date" id="end-date"
                                                                    class="form-control"
                                                                    wire:model.live.debounce.500ms='end_date_admin'>
                                                            </div>
                                                        @else
                                                            <div class="col-lg-6">
                                                                <p class="text-center mb-1">{{ __('Start') }}</p>
                                                                <input type="date" name="start-date-admin"
                                                                    id="start-date-admin" class="form-control"
                                                                    wire:model='start_date_admin'>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <p class="text-center mb-1">{{ __('End') }}</p>
                                                                <input type="date" name="end-date-admin"
                                                                    id="end-date-admin" class="form-control"
                                                                    wire:model.live.debounce.500ms='end_date_admin'>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    {{-- <div class="row mt-3">
                                                        <button type="submit" class="btn btn-success text-white">Submit</button>
                                                    </div> --}}
                                                    {{-- </form> --}}
                                                </div>
                                                <div class="col-lg-4">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Teknisi'))
                                        <input wire:model.live.debounce.250ms='search' type="text" name="search"
                                            id="search" class="form-control mb-3 w-25" placeholder="Search...">
                                    @else
                                        <input wire:model.live.debounce.250ms='adminSearch' type="text"
                                            name="search" id="search" class="form-control mb-3 w-25"
                                            placeholder="Search...">
                                    @endif
                                </div>
                                @if (auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Teknisi'))
                                    <div class="col-lg-6 d-flex justify-content-end align-items-center">
                                        <a class="btn btn-info" href="{{ route('devices.printAll') }}"
                                            target="_blank"><i class="fas fa-print"></i>
                                            {{ __('Print Semua QR Kosong') }}</a>
                                    </div>
                                @endif

                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="#export" class="btn btn-primary" wire:click='export'>XLS</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="table-wrapper table-responsive">
                                        <table class="table striped-table text-black text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2em;">No</th>
                                                    <th>{{ __('Tanggal') }}</th>
                                                    <th>{{ __('Nama Alat') }}</th>
                                                    <th>{{ __('Merek') }}</th>
                                                    <th>{{ __('Tipe') }}</th>
                                                    <th>{{ __('No. Seri') }}</th>
                                                    <th>{{ __('Ruang') }}</th>
                                                    <th>{{ __('Tanggal Kalibrasi') }}</th>
                                                    <th>{{ __('Nomor Sertifikat') }}</th>
                                                    <th>{{ __('Hasil') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Petugas Kalibrasi') }}</th>
                                                    <th style="width: 5em;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Manager') || auth()->user()->hasRole('Admin'))
                                                    @if ($alatSuperadmin->isEmpty())
                                                        <tr>
                                                            <td colspan='13' class="text-center fw-bold">
                                                                {{ __('Data tidak ditemukan') }}
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($alatSuperadmin as $sadmin)
                                                            <tr>
                                                                <td>{{ $alatSuperadmin->firstItem() + $loop->index }}
                                                                </td>
                                                                <td>{{ date('d/m/Y', strtotime($sadmin->created_at)) ?? '' }}
                                                                </td>
                                                                <td>{{ $sadmin->devNames->name ?? '' }}</td>
                                                                <td>{{ $sadmin->brand ?? '' }}</td>
                                                                <td>{{ $sadmin->type ?? '' }}</td>
                                                                <td>{{ $sadmin->serial_number ?? '' }}</td>
                                                                <td>{{ $sadmin->location ?? '' }}</td>
                                                                @if ($sadmin->calibration_date == null)
                                                                    <td></td>
                                                                @else
                                                                    <td>{{ date('d M Y', strtotime($sadmin->calibration_date)) ?? '' }}
                                                                    </td>
                                                                @endif
                                                                @if ($sadmin->certif_file == null)
                                                                    <td></td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ asset('storage/' . $sadmin->certif_file) }}"
                                                                            target="_blank"><i
                                                                                class="fas fa-up-right-from-square"></i>
                                                                            {{ 'Lihat sertifikat' }}</a>
                                                                    </td>
                                                                @endif
                                                                <td>{{ $sadmin->result ?? 'Laik Pakai' }}</td>
                                                                <td>{{ $sadmin->status ?? 'Tersedia' }}</td>
                                                                <td>{{ $sadmin->users->name ?? '' }}</td>
                                                                <td>
                                                                    <a href="{{ route('devices.detail', $sadmin->deviceId) }}"
                                                                        class="btn btn-primary" target="_blank"><i
                                                                            class="fas fa-eye"></i></a>
                                                                    <a class="btn btn-secondary" target="_blank"
                                                                        wire:click="print('{{ $sadmin->deviceId }}')"><i
                                                                            class="fas fa-print"></i></a>
                                                                    @if (auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Admin'))
                                                                        <a href="{{ route('devices.edit', $sadmin->deviceId) }}"
                                                                            class="btn btn-info"><i
                                                                                class="fas fa-pen-to-square"></i></a>
                                                                        <button class="btn btn-danger"
                                                                            wire:click.prevent="deleteConfirm('{{ $sadmin->deviceId }}')"><i
                                                                                class="fas fa-trash"></i></button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @else
                                                    @if ($alats->isEmpty())
                                                        <tr>
                                                            <td colspan='13' class="text-center">
                                                                {{ __('Data tidak ditemukan') }}
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($alats as $device)
                                                            <tr>
                                                                <td>{{ $alats->firstItem() + $loop->index }}</td>
                                                                <td>{{ date('d/m/Y', strtotime($device->created_at)) ?? '' }}
                                                                <td>{{ $device->devNames->name ?? '' }}</td>
                                                                <td>{{ $device->brand ?? '' }}</td>
                                                                <td>{{ $device->type ?? '' }}</td>
                                                                <td>{{ $device->serial_number ?? '' }}</td>
                                                                <td>{{ $device->location ?? '' }}</td>
                                                                @if ($device->calibration_date == null)
                                                                    <td></td>
                                                                @else
                                                                    <td>{{ date('j F Y', strtotime($device->calibration_date)) ?? '' }}
                                                                    </td>
                                                                @endif
                                                                @if ($device->certif_file == null)
                                                                    <td></td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ asset('storage/' . $device->certif_file) }}"
                                                                            target="_blank"><i
                                                                                class="fas fa-up-right-from-square"></i>
                                                                            {{ 'Lihat sertifikat' }}</a>
                                                                    </td>
                                                                @endif
                                                                <td>{{ $device->result ?? '' }}</td>
                                                                <td>{{ $device->status ?? '' }}</td>
                                                                <td>{{ $device->users->name ?? '' }}</td>
                                                                <td>
                                                                    <a href="{{ route('devices.detail', $device->deviceId) }}"
                                                                        class="btn btn-primary" target="_blank"><i
                                                                            class="fas fa-eye"></i></a>
                                                                    <a class="btn btn-secondary" target="_blank"
                                                                        wire:click="print('{{ $device->deviceId }}')"><i
                                                                            class="fas fa-print"></i></a>
                                                                    <a href="{{ route('devices.edit', $device->deviceId) }}"
                                                                        class="btn btn-info"><i
                                                                            class="fas fa-pen-to-square"></i></a>
                                                                    <button class="btn btn-danger"
                                                                        wire:click.prevent="deleteConfirm('{{ $device->deviceId }}')"><i
                                                                            class="fas fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="row mt-4">
                                            <div class="col-lg-6 d-flex align-items-center justify-content-start">
                                                <label class="text-black font-bold form-label me-3 mb-0">Per
                                                    Page</label>
                                                <select wire:model.live='perPage'
                                                    class="form-control text-black per-page" style="width: 7%">
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 d-flex align-items-center justify-content-end">
                                                @if (auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Manager') || auth()->user()->hasRole('Admin'))
                                                    @if (!$alatSuperadmin->isEmpty())
                                                        {{-- <div class="pagination-text me-3 mb-3 text-muted">
                                                            @if ($alatSuperadmin->total() > 0)
                                                                Showing {{ $alatSuperadmin->firstItem() }} -
                                                                {{ $alatSuperadmin->lastItem() }} of
                                                                {{ $alatSuperadmin->total() }}
                                                            @endif
                                                        </div> --}}
                                                        {{ $alatSuperadmin->links() }}
                                                    @endif
                                                @else
                                                    @if (!$alats->isEmpty())
                                                        <div class="pagination-text me-3 mb-3">
                                                            {{-- @if ($alats->total() > 0)
                                                                Showing {{ $alats->firstItem() }} -
                                                                {{ $alats->lastItem() }} of
                                                                {{ $alats->total() }}
                                                            @endif --}}
                                                        </div>
                                                        {{ $alats->links() }}
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        window.addEventListener('delete-confirmation', event => {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Alat akan terhapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.dispatch('deleteConfirmed');
                }
            });
        })
    </script>
    <script>
        window.addEventListener('print-qr', event => {
            $wire.dispatch('printThisQR');
        })
    </script>
@endscript

@if (session()->has('alert'))
    @script
        <script>
            const alerts = @json(session()->get('alert'));
            const title = alerts.title;
            const icon = alerts.type;
            const toast = alerts.toast;
            const position = alerts.position;
            const timer = alerts.timer;
            const progbar = alerts.progbar;
            const confirm = alerts.showConfirmButton;

            Swal.fire({
                title: title,
                icon: icon,
                toast: toast,
                position: position,
                timer: timer,
                timerProgressBar: progbar,
                showConfirmButton: confirm
            });
        </script>
    @endscript
@endif
