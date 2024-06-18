<div>
    <div class="py-4 main">
        <div class="back-button mb-4">
            <a href="{{ route('inventories.index') }}" class="btn btn-info text-white" wire:navigate><i
                    class="fas fa-arrow-left"></i>
                {{ __('Kembali') }}</a>
        </div>
        <div class="row mb-4">
            <div class="col-lg-3">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col">
                                    <h2 class="mb-1 fs-4 fw-bold mb-3 text-center">{{ __('Detail Inventaris') }}</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 text-start">
                                    <h6 class="mb-3">{{ __('No. Inventory') }}</h6>
                                    <h6 class="mb-3">{{ __('Nama') }}</h6>
                                    <h6 class="mb-3">{{ __('Merk') }}</h6>
                                    <h6 class="mb-3">{{ __('Tipe') }}</h6>
                                    <h6 class="mb-3">{{ __('S/N') }}</h6>
                                    <h6 class="mb-3">{{ __('Tahun') }}</h6>
                                    <h6 class="mb-3">{{ __('Kalibrasi Terakhir') }}</h6>
                                    <h6 class="mb-3">{{ __('Kalibrasi Selanjutnya') }}</h6>
                                    <h6 class="mb-3">{{ __('PIC') }}</h6>
                                    <h6 class="mb-3">{{ __('Lokasi') }}</h6>
                                    <h6 class="mb-3">{{ __('Status') }}</h6>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <h6 class="mb-3">{{ $invDetail->inv_number ?? '' }}</h6>
                                    <h6 class="mb-3">{{ $invDetail->devnames->name ?? '' }}</h6>
                                    <h6 class="mb-3">{{ $invDetail->brand ?? '' }}</h6>
                                    <h6 class="mb-3">{{ $invDetail->type ?? '' }}</h6>
                                    <h6 class="mb-3">{{ $invDetail->sn ?? '' }}</h6>
                                    <h6 class="mb-3">{{ $invDetail->procurement_year ?? '' }}</h6>
                                    <h6 class="mb-3">{{ date('j F Y', strtotime($invDetail->last_calibrated_date)) }}
                                    </h6>
                                    <h6 class="mb-3">{{ date('j F Y', strtotime($invDetail->next_calibrated_date)) }}
                                    </h6>
                                    <h6 class="mb-3">{{ $invDetail->pic }}</h6>
                                    <h6 class="mb-3">{{ $invDetail->location }}</h6>
                                    @if(empty($latest) || Carbon\Carbon::parse($latest->tanggal_selesai_pinjam) <= Carbon\Carbon::today())
                                        <h6 class="mb-3">{{ __('Tersedia') }}</h6>
                                    @elseif (Carbon\Carbon::parse($latest->tanggal_selesai_pinjam) > Carbon\Carbon::today())
                                        <h6 class="mb-3">{{ __('Dipinjamkan') }}</h6>
                                    @endif
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
                            <h2 class="mb-1 fs-5 fw-bold mb-3 text-center">{{ __('Log Book') }}</h2>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input wire:model.live.debounce.250ms='searchByInventoryId' type="text"
                                        name="search" id="search" class="form-control mb-3 w-25"
                                        placeholder="Search...">
                                </div>
                                <div class="col-lg-6 d-flex align-items-center justify-content-end">
                                    @if (empty($latest) || Carbon\Carbon::parse($latest->tanggal_selesai_pinjam) <= Carbon\Carbon::today())
                                        <a href="{{ route('inventories.add_log', $invDetail->inventoryId) }}"
                                            class="btn btn-success text-white" wire:navigate><i class="fas fa-plus"></i>
                                            {{ __('Tambah Log') }}</a>
                                    @elseif (Carbon\Carbon::parse($latest->tanggal_selesai_pinjam) > Carbon\Carbon::today())
                                        <a href="{{ route('inventories.add_log', $invDetail->inventoryId) }}"
                                            class="btn btn-success text-white disabled" wire:navigate disabled><i
                                                class="fas fa-plus"></i> {{ __('Tambah Log') }}</a>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="table-wrapper">
                                        <table class="table table-responsive striped-table text-black text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2em;">No</th>
                                                    <th>{{ __('Tanggal Pinjam') }}</th>
                                                    <th>{{ __('PIC') }}</th>
                                                    <th>{{ __('Lokasi') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($logDetail->isEmpty())
                                                    <tr>
                                                        <td colspan='11' class="text-center">
                                                            {{ __('Data tidak ditemukan') }}
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($logDetail as $log)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            @if (empty($log->tanggal_mulai_pinjam && $log->tanggal_selesai_pinjam) ||
                                                                    empty($log->tanggal_mulai_pinjam) ||
                                                                    empty($log->tanggal_selesai_pinjam))
                                                                <td></td>
                                                            @else
                                                                <td>{{ date('j M Y', strtotime($log->tanggal_mulai_pinjam)) }}
                                                                    s/d
                                                                    {{ date('j M Y', strtotime($log->tanggal_selesai_pinjam)) }}
                                                                </td>
                                                            @endif
                                                            <td>{{ $log->pic_pinjam ?? '' }}</td>
                                                            <td>{{ $log->lokasi_pinjam ?? '' }}</td>
                                                            <td>{{ $log->status ?? '' }}</td>
                                                            <td>
                                                                <a href="{{ route('inventories.edit_log', ['inventoryId' => $invDetail->inventoryId, 'logId' => $log->logId]) }}"
                                                                    class="btn btn-info" wire:navigate><i class="fas fa-edit"></i></a>
                                                                <button class="btn btn-danger"
                                                                    wire:click.prevent="deleteConfirm('{{ $log->logId }}')"><i
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
                                                @if (!$logDetail->isEmpty())
                                                    {{ $logDetail->links() }}
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
        window.addEventListener('delete-confirmation', event => {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Log untuk Nomor Inventaris ini akan terhapus secara permanen!",
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
