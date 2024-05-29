<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-3">{{ __('Semua Rumah Sakit') }}</h2>
                            <div class="row mb-4">
                                <div class="col d-flex justify-content-end">
                                    <a href="{{ route('hospitals.create') }}" class="btn btn-success text-white"><i
                                            class="fas fa-plus"></i>
                                        {{ __('Tambah Rumah Sakit') }}</a>
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
                                    <div class="table-wrapper">
                                        <table class="table table-responsive striped-table text-black text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2em;">No</th>
                                                    <th>{{ __('Nama') }}</th>
                                                    <th>{{ __('No Telpon') }}</th>
                                                    <th>{{ __('Alamat') }}</th>
                                                    <th style="width: 5em;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($rs->isEmpty())
                                                <tr>
                                                    <td colspan='11' class="text-center">
                                                        {{ __('Data tidak ditemukan') }}
                                                    </td>
                                                </tr>
                                                @else
                                                @foreach ($rs as $rs)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $rs->name ?? '' }}</td>
                                                    <td>{{ $rs->phone_number ?? '' }}</td>
                                                    <td>{{ $rs->address ?? '' }}</td>
                                                    <td>
                                                        <a href="{{ route('hospitals.detail', $rs->hospitalId) }}"
                                                            class="btn btn-primary" wire:navigate><i
                                                                class="fas fa-eye"></i></a>
                                                        <a href="{{ route('hospitals.edit', $rs->hospitalId) }}"
                                                            class="btn btn-info" wire:navigate><i
                                                                class="fas fa-pen-to-square"></i></a>
                                                        <button class="btn btn-danger"
                                                            wire:click.prevent="deleteConfirm('{{ $rs->hospitalId }}')"><i
                                                                class="fas fa-trash"></i></button>

                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="paginate mt-4">
                                            <div class="d-flex align-items-center data-row">
                                                <label class="text-black font-bold form-label me-3 mb-0">Per
                                                    Page</label>
                                                <select wire:model.live='perPage'
                                                    class="form-control text-black per-page" style="width: 5%">
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                            @if (!empty($inventory))
                                            {{ $inventory->links() }}
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
@script
<script>
    window.addEventListener('delete-confirmation', event => {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Rumah Sakit akan terhapus secara permanen!",
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
