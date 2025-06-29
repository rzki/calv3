<div>
    <div class="py-4 main">
        <div class="back-button mb-4">
            <a href="{{ route('dashboard') }}" class="btn btn-info text-white"><i class="fas fa-arrow-left"></i>
                {{ __('Kembali') }}</a>
        </div>
        <div class="row mb-4">
            <div class="col-lg-3">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col">
                                    <h2 class="mb-1 fs-4 fw-bold mb-3 text-center">{{ __('Detail Data Pelanggan') }}
                                    </h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 text-start">
                                    <h6 class="mb-3">{{ __('Nama') }}</h6>
                                    <h6 class="mb-3">{{ __('No Telepon') }}</h6>
                                    <h6>{{ __('Alamat') }}</h6>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <h6 class="mb-3">{{ $detailRS->name }}</h6>
                                    <h6 class="mb-3">{{ $detailRS->phone_number }}</h6>
                                    <h6>{{ $detailRS->address }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-3 text-center">{{ __('List Alat') }}</h2>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input wire:model.live.debounce.250ms='search' type="text" name="search" id="search"
                                        class="form-control mb-3 w-25" placeholder="Search...">
                                </div>
                                <div class="col-lg-6 d-flex align-items-center justify-content-end">
                                    @can('userRs')
                                    <a href="{{ route('hospitals.add_device', $detailRS->hospitalId) }}"
                                        class="btn btn-success text-white"><i class="fas fa-plus"></i>
                                        {{ __('Tambah Alat') }}</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="export">
                                        <button class="btn btn-primary text-center fw-bold"
                                            wire:click='export'>XLS</button>
                                    </div>
                                    <div class="table-responsive table-wrapper">
                                        <table class="table table-responsive striped-table text-black text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2em;">No</th>
                                                    <th>{{ __('Nama') }}</th>
                                                    <th>{{ __('Merk') }}</th>
                                                    <th>{{ __('Tipe') }}</th>
                                                    <th>{{ __('No Seri') }}</th>
                                                    <th>{{ __('Ruang') }}</th>
                                                    <th>{{ __('Tgl Kalibrasi') }}</th>
                                                    <th>{{ __('Kalibrasi Selanjutnya') }}</th>
                                                    <th>{{ __('No. Sertifikat') }}</th>
                                                    <th>{{ __('Sertifikat') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    @if (auth()->user()->hasRole('Superadmin') ||
                                                    auth()->user()->hasRole('Admin'))
                                                    <th style="width: 5em;"></th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($alatRS->isEmpty())
                                                <tr>
                                                    <td colspan='11' class="text-center">
                                                        {{ __('Data tidak ditemukan') }}
                                                    </td>
                                                </tr>
                                                @else
                                                @foreach ($alatRS as $alat)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $alat->devNames->name ?? '' }}</td>
                                                    <td>{{ $alat->brand ?? '' }}</td>
                                                    <td>{{ $alat->type ?? ''}}</td>
                                                    <td>{{ $alat->serial_number ?? '' }}</td>
                                                    <td>{{ $alat->location ?? '' }}</td>
                                                    @if (empty($alat->calibration_date))
                                                    <td></td>
                                                    @else
                                                    <td>{{ date('d/m/Y', strtotime($alat->calibration_date)) ?? '' }}
                                                    </td>
                                                    @endif
                                                    @if (empty($alat->next_calibration_date))
                                                    <td></td>
                                                    @else
                                                    <td>{{ date('d/m/Y', strtotime($alat->next_calibration_date)) ?? ''
                                                        }}
                                                    </td>
                                                    @endif
                                                    <td>{{ $alat->certif_no ?? '' }}</td>
                                                    @if ($alat->certif_file == null)
                                                    <td></td>
                                                    @else
                                                    <td>
                                                        <a href="{{ asset('storage/'.$alat->certif_file) }}"
                                                            target="_blank"><i class="fas fa-up-right-from-square"></i>
                                                            {{ 'Lihat sertifikat' }}</a>
                                                    </td>

                                                    @endif
                                                    <td>{{ $alat->status ?? '' }}</td>
                                                    @if (!auth()->user()->hasRole('Manager'))
                                                    <td>
                                                        <button class="btn btn-danger"
                                                            wire:click.prevent="unlinkConfirm('{{ $alat->deviceId }}')"><i
                                                                class="fas fa-trash"></i></button>
                                                    </td>
                                                    @endif
                                                </tr>
                                                @endforeach
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
                                                @if (!$alatRS->isEmpty())
                                                {{ $alatRS->links() }}
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

        {{-- Table --}}
        <div class="row">
        </div>
    </div>
</div>
@script
<script>
    window.addEventListener('unlink-confirmation', event => {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Alat ini akan terhapus dari Data Pelanggan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.dispatch('unlinkConfirmed');
                }
            });
        });
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
