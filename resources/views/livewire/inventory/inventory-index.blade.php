<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-3">{{ __('Semua Inventaris') }}</h2>
                            <div class="row mb-4">
                                <div class="col d-flex justify-content-end">
                                    <a href="{{ route('inventories.create') }}" class="btn btn-success text-white"><i class="fas fa-plus"></i>
                                        Tambah Inventaris</a>
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
                                    <div class="table-wrapper">
                                        <table class="table table-responsive striped-table text-black text-center">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2em;">No</th>
                                                    <th>Nama</th>
                                                    <th>Merk</th>
                                                    <th>Tipe</th>
                                                    <th>S/N</th>
                                                    <th>Tahun Pengadaan</th>
                                                    <th>Kalibrasi Terakhir</th>
                                                    <th>PIC</th>
                                                    <th>Lokasi</th>
                                                    <th>Status</th>
                                                    <th style="width: 5em;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($inventory->isEmpty())
                                                    <tr>
                                                        <td colspan='11' class="text-center">
                                                            {{ __('Data tidak ditemukan') }}
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($inventory as $inv)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $inv->devnames->name ?? '' }}</td>
                                                            <td>{{ $inv->brand ?? '' }}</td>
                                                            <td>{{ $inv->type ?? '' }}</td>
                                                            <td>{{ $inv->sn ?? '' }}</td>
                                                            <td>{{ $inv->procurement_year ?? '' }}</td>
                                                            <td>{{ $inv->inv_number ?? '' }}</td>
                                                            <td>{{ date('j F Y', $inv->last_calibrated_date) ?? '' }}</td>
                                                            <td>{{ $inv->pic ?? '' }}</td>
                                                            <td>{{ $inv->lokasi ?? '' }}</td>
                                                            <td>{{ $inv->status ?? '' }}</td>
                                                            <td>
                                                                <a href="{{ route('inventory.detail', $inv->inventoryId) }}"
                                                                    class="btn btn-info" target="_blank"><i
                                                                        class="fas fa-eye"></i></a>
                                                                <a href="{{ route('inventory.edit', $inv->inventoryId) }}"
                                                                    class="btn btn-primary"><i
                                                                        class="fas fa-pen-to-square"></i></a>
                                                                <button class="btn btn-danger"
                                                                    wire:click.prevent="deleteConfirm('{{ $inv->inventoryId }}')"><i
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
