<div>
    <div class="py-4 main">
        <div class="back-button mb-4">
            <a href="{{ route('hospitals.index') }}" class="btn btn-info text-white"><i class="fas fa-arrow-left"></i>
                {{ __('Kembali') }}</a>
        </div>
        <div class="row mb-4">
            <div class="col-lg-3">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col">
                                    <h2 class="mb-1 fs-4 fw-bold mb-3 text-center">{{ __('Detail Rumah Sakit') }}</h2>
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
                                    <input wire:model.live.debounce.250ms='search' type="text" name="search"
                                        id="search" class="form-control mb-3 w-25" placeholder="Search...">
                                </div>
                                <div class="col-lg-6 d-flex align-items-center justify-content-end">
                                    <a href="{{ route('hospitals.create') }}" class="btn btn-success text-white"><i
                                            class="fas fa-plus"></i>
                                        {{ __('Tambah Alat') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="table-wrapper">
                                        <table class="table table-responsive striped-table text-black text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2em;">No</th>
                                                    <th>{{ __('Nama') }}</th>
                                                    <th>{{ __('Serial Number') }}</th>
                                                    <th>{{ __('Kalibrasi Selanjutnya') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th style="width: 5em;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($alat->isEmpty())
                                                    <tr>
                                                        <td colspan='11' class="text-center">
                                                            {{ __('Data tidak ditemukan') }}
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($alat as $alat)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $alat->names->name ?? '' }}</td>
                                                            <td>{{ $alat->serial_number ?? '' }}</td>
                                                            @if (empty($alat->calibration_date))
                                                                <td></td>
                                                            @else
                                                                <td>{{ date('j M Y', strtotime($alat->calibration_date)) ?? '' }}
                                                                </td>
                                                            @endif
                                                            <td>{{ $alat->status ?? '' }}</td>
                                                            <td>
                                                                <a href="{{ route('hospitals.edit_device', ['hospitalId' => $detailRS->hospitalId, 'deviceId' => $alat->deviceId]) }}"
                                                                    class="btn btn-info" wire:navigate><i
                                                                        class="fas fa-pen-to-square"></i></a>
                                                                <button class="btn btn-danger"
                                                                    wire:click.prevent="unlinkConfirm('{{ $alat->deviceId }}')"><i
                                                                        class="fas fa-trash"></i></button>

                                                            </td>
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
                                                @if (!$alat->isEmpty())
                                                    {{ $alat->links() }}
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
        // window.addEventListener('delete-confirmation', event => {
        //     Swal.fire({
        //         title: "Apakah anda yakin?",
        //         text: "Alat ini akan terhapus secara permanen!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Yes"
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $wire.dispatch('deleteConfirmed');
        //         }
        //     });
        // });
        window.addEventListener('unlink-confirmationconfirmation', event => {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Alat ini akan terhapus dari rumah sakit ini!",
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
