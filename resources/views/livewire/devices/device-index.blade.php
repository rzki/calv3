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
                                    <div class="table-wrapper table-responsive">
                                        <table class="table striped-table text-black text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2em;">No</th>
                                                    <th>{{ __('Nama') }}</th>
                                                    <th>{{ __('Serial Number') }}</th>
                                                    <th>{{ __('Tanggal Kalibrasi') }}</th>
                                                    <th>{{ __('Nomor Sertifikat') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Dibuat oleh') }}</th>
                                                    <th style="width: 5em;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Manager') || auth()->user()->hasRole('Admin'))
                                                    @if ($alatSuperadmin->isEmpty())
                                                        <tr>
                                                            <td colspan='8' class="text-center">
                                                                {{ __('Data tidak ditemukan') }}
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($alatSuperadmin as $sadmin)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $sadmin->names->name ?? '' }}</td>
                                                                <td>{{ $sadmin->serial_number ?? '' }}</td>
                                                                @if ($sadmin->calibration_date == null)
                                                                    <td></td>
                                                                @else
                                                                    <td>{{ date('j F Y', strtotime($sadmin->calibration_date)) ?? '' }}
                                                                    </td>
                                                                @endif
                                                                @if ($sadmin->certif_file == null)
                                                                    <td></td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ asset('storage/'.$sadmin->certif_file) }}" target="_blank"><i class="fas fa-up-right-from-square"></i> {{ 'Lihat sertifikat' }}</a>
                                                                    </td>
                                                                @endif
                                                                <td>{{ $sadmin->status ?? '' }}</td>
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
                                                            <td colspan='8' class="text-center">
                                                                {{ __('Data tidak ditemukan') }}
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($alats as $device)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $device->names->name ?? '' }}</td>
                                                                <td>{{ $device->serial_number ?? '' }}</td>
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
                                                                    <a href="{{ asset('storage/'.$device->certif_file) }}" target="_blank"><i class="fas fa-up-right-from-square"></i>
                                                                        {{ 'Lihat sertifikat' }}</a>
                                                                </td>
                                                                @endif
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
                                            <div class="col d-flex align-items-center justify-content-start">
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
                                            <div class="col d-flex align-items-center justify-content-end">
                                                @if (auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Manager') || auth()->user()->hasRole('Admin'))
                                                    @if (!$alatSuperadmin->isEmpty())
                                                        {{ $alatSuperadmin->links() }}
                                                    @endif
                                                @else
                                                    @if (!$alats->isEmpty())
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
