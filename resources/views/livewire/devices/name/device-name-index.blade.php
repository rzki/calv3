<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-3">{{ __('Semua Nama Alat') }}</h2>
                            <div class="row mb-4">
                                <div class="col d-flex justify-content-end">
                                    @if (auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Teknisi'))
                                        <a href="{{ route('device_name.create') }}" wire:navigate
                                            class="btn btn-success text-white"><i class="fas fa-plus"></i>
                                            {{ __('Tambah Nama Alat') }}</a>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input wire:model.live.debounce.250ms='search' type="text" name="search"
                                        id="search" class="form-control mb-3 w-25" placeholder="Search...">
                                </div>
                                <div class="col-lg-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="table-wrapper table-responsive">
                                        <table class="table striped-table text-black text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2em;">No</th>
                                                    <th>{{ __('Nama') }}</th>
                                                    @if (auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Teknisi'))
                                                        <th style="width: 5em;"></th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($devnames->isEmpty())
                                                    @if (auth()->user()->hasRole('Superadmin') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Teknisi'))
                                                    <tr>
                                                        <td colspan='3' class="text-center">
                                                            {{ __('Data tidak ditemukan') }}
                                                        </td>
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <td colspan='2' class="text-center">
                                                            {{ __('Data tidak ditemukan') }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @else
                                                    @foreach ($devnames as $name)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $name->name }}</td>
                                                            @if (auth()->user()->hasRole('Superadmin') ||auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Teknisi'))
                                                                <td>
                                                                    <a href="{{ route('device_name.edit', $name->id) }}"
                                                                        class="btn btn-info"><i
                                                                            class="fas fa-pen-to-square"></i> </a>
                                                                    <button class="btn btn-danger"
                                                                        wire:click.prevent="deleteConfirm('{{ $name->id }}')"><i
                                                                            class="fas fa-trash"></i> </button>
                                                                </td>
                                                            @endif
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
                                                    class="form-control text-black per-page" style="width: 7%">
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                            @if (!$devnames->isEmpty())
                                                {{ $devnames->links() }}
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
                text: "Nama Alat ini dan data yang terdaftar menggunakan nama ini akan terhapus!",
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
