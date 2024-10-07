<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                        <div class="row mb-3">
                            <div class="col d-flex justify-content-start">
                                <a href="{{ route('inventories.index') }}" class="btn btn-primary" wire:navigate><i class="fas fa-arrow-left"></i>
                                    {{ __('Kembali') }}</a>
                            </div>
                        </div>
                            <h2 class="mb-1 fs-5 fw-bold mb-3">{{ __('Histori Inventaris ' . $inventory->device_name) }}</h2>
                            <div class="row mb-4">
                                <div class="col d-flex justify-content-end">
                                    @if(Auth::user()->hasRole('Superadmin') || Auth::user()->hasRole('Admin') ||
                                    Auth::user()->hasRole('Teknisi'))
                                    <a href="{{ route('inventories.history.create', $this->inventory->inventoryId) }}" class="btn btn-success text-white"><i
                                            class="fas fa-plus"></i>
                                        {{ __('Tambah Histori') }}</a>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input wire:model.live.debounce.250ms='search' type="text" name="search" id="search"
                                        class="form-control mb-3 w-25" placeholder="Search...">
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
                                                    <th>{{ __('Kegiatan') }}</th>
                                                    <th>{{ __('Keterangan') }}</th>
                                                    <th style="width: 5em;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($histories->isEmpty())
                                                <tr>
                                                    <td colspan='4' class="text-center">
                                                        {{ __('Data tidak ditemukan') }}
                                                    </td>
                                                </tr>
                                                @else
                                                @foreach ($histories as $history)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    @if ($history->date == null)
                                                        <td></td>
                                                    @else
                                                        <td>{{ date('d/m/Y', strtotime($history->date)) }}</td>
                                                    @endif
                                                    <td>{{ $history->activity ?? '' }}</td>
                                                    <td>{{ $history->description ?? '' }}</td>
                                                    <td>
                                                        @if (auth()->user()->hasRole(['Superadmin','Admin']))
                                                        <a href="{{ route('inventories.history.edit', ['inventoryId' => $inventories->inventoryId, 'historyId' => $history->historyId]) }}"
                                                            class="btn btn-info" wire:navigate><i
                                                                class="fas fa-pen-to-square"></i></a>
                                                        <button class="btn btn-danger"
                                                            wire:click.prevent="deleteConfirm('{{ $history->historyId }}')"><i
                                                                class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
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
                                                @if (!$histories->isEmpty())
                                                {{ $histories->links() }}
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
                text: "Histori Inventaris akan terhapus secara permanen!",
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
