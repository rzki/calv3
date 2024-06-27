<div>
    <div class="container">
        <div class="row vh-100">
            <div class="col d-flex flex-column justify-content-center">
                <h1 class="text-center mb-4">{{ __('List Alat') }}</h1>
                <div class="search-box mb-4">
                    <input type="text" name="search" id="search" wire:model.live.debounce.250ms='search' placeholder="Search..." class="form-control w-25">
                </div>
                <div class="table">
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead>
                                <th>{{ __('No') }}</th>
                                <th>{{ __('Barcode') }}</th>
                                <th>{{ __('Nama Alat') }}</th>
                                <th>{{ __('Merk') }}</th>
                                <th>{{ __('Tipe') }}</th>
                                <th>{{ __('No. Seri') }}</th>
                                <th>{{ __('Kalibrasi Terakhir') }}</th>
                                <th>{{ __('Kalibrasi Selanjutnya') }}</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($listAlat as $alat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('storage/'.$alat->barcode) }}" class="w-50" alt="">
                                        </td>
                                        <td>{{ $alat->names->name ?? '' }}</td>
                                        <td>{{ $alat->brand ?? '' }}</td>
                                        <td>{{ $alat->type ?? '' }}</td>
                                        <td>{{ $alat->serial_number ?? '' }}</td>
                                        @if ($alat->calibration_date == null)
                                            <td></td>
                                        @else
                                            <td>{{ date('j F Y', strtotime($alat->calibration_date)) ?? '' }}
                                            </td>
                                        @endif
                                        @if ($alat->next_calibration_date == null)
                                            <td></td>
                                        @else
                                            <td>{{ date('j F Y', strtotime($alat->next_calibration_date)) ?? '' }}
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{ route('devices.publicDetail', $alat->deviceId) }}" class="btn btn-dark" wire:navigate>
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row mt-4 px-4 gx-0">
                            <div class="col d-flex align-items-center justify-content-start">
                                <label class="text-black font-bold form-label me-3 mb-0">Per
                                    Page</label>
                                <select wire:model.live='perPage' class="form-control text-black per-page" style="width: 7%">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col d-flex align-items-center justify-content-end">
                                @if (!$listAlat->isEmpty())
                                {{ $listAlat->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
