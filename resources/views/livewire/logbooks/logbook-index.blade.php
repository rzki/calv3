<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold">{{ __('Log Book') }}</h2>
                            <div class="row mb-4">
                                <div class="col d-flex justify-content-end">
                                    @can('logbooks')
                                    <a href="{{ route('logbooks.create') }}" class="btn btn-success text-white" wire:navigate><i class="fas fa-plus"></i>
                                        {{ __('Tambah Log') }}</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input wire:model.live.debounce.250ms='search' type="text" name="search"
                                        id="search" class="form-control mb-3 w-25" placeholder="Search...">
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
                                                    <th>{{ __('Tanggal Pinjam') }}</th>
                                                    <th>{{ __('Lokasi') }}</th>
                                                    <th>{{ __('Aksesoris') }}</th>
                                                    <th>{{ __('PIC') }}</th>
                                                    <th>{{ __('Tanggal Kembali') }}</th>
                                                    <th style="width: 5em;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($logInv->isEmpty())
                                                    <tr>
                                                        <td colspan='11' class="text-center">
                                                            {{ __('Data tidak ditemukan') }}
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($logInv as $log)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            @if ($log->date == null)
                                                                <td></td>
                                                            @else
                                                                <td>{{ date('d/m/Y', strtotime($log->date)) }}</td>
                                                            @endif
                                                            @if ($log->mulai_pinjam == null)
                                                                <td></td>
                                                            @else
                                                                <td>{{ date('d/m/Y', strtotime($log->tanggal_pinjam)) }}</td>
                                                            @endif
                                                            <td>{{ $log->lokasi_pinjam ?? '' }}</td>
                                                            <td>{{ $log->aksesoris ?? '' }}</td>
                                                            <td>{{ $log->pic_pinjam }}</td>
                                                            @if ($log->selesai_pinjam == null)
                                                                <td></td>
                                                            @else
                                                                <td>{{ date('d/m/Y', strtotime($log->selesai_pinjam)) }}</td>
                                                            @endif
                                                            @if (Auth::user()->hasRole(['Superadmin', 'Admin']))
                                                                <td>
                                                                    <a href="{{ route('logbooks.edit', $log->logId) }}" class="btn btn-primary"><i
                                                                            class="fas fa-pen-to-square"></i></a>
                                                                    <button class="btn btn-danger"
                                                                        wire:click.prevent="deleteConfirm('{{ $log->logId }}')"><i
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
                                                @if (!$logInv->isEmpty())
                                                    {{ $logInv->links() }}
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
                text: "Log akan terhapus secara permanen!",
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
