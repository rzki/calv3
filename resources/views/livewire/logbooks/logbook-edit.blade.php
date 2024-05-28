<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-5">{{ __('Edit Log Pinjam') }}</h2>
                            <div class="row mb-5">
                                <div class="col">
                                    <a href="{{ route('logbooks.index') }}" wire:navigate
                                        class="btn btn-primary text-white"><i class="fas fa-arrow-left"></i>
                                        Kembali</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form wire:submit='update' method="post">
                                        <div class="form-group mb-3">
                                            <label for="no_inv"
                                                class="form-label text-capitalize">{{ __('no. inventaris alat') }}</label>
                                            <select name="no_inv" id="no_inv" class="form-control" wire:model='no_inv'>
                                                <option value="">Pilih salah satu...</option>
                                                @foreach ($invId as $name)
                                                    <option value="{{ $name->id }}" {{ old('inventory_id', $logs->inventory_id) == $name->id ? 'selected' : ''  }}>{{ $name->inv_number }} ({{ $name->devnames->name }}, {{ $name->brand }}, {{ $name->type }}, {{ $name->sn }}, {{ $name->procurement_year }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="tanggal_mulai_pinjam" class="form-label text-capitalize">{{ __('mulai pinjam') }}</label>
                                                    <input type="date" name="tanggal_mulai_pinjam" id="tanggal_mulai_pinjam" class="form-control" wire:model='mulai_pinjam'>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="tanggal_selesai_pinjam" class="form-label text-capitalize">{{ __('selesai pinjam') }}</label>
                                                    <input type="date" name="tanggal_selesai_pinjam" id="tanggal_selesai_pinjam" class="form-control" wire:model='selesai_pinjam'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="lokasi"
                                                class="form-label text-capitalize">{{ __('lokasi pinjam') }}</label>
                                            <input type="text" class="form-control" wire:model='lokasi_pinjam'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="pic"
                                                class="form-label text-capitalize">{{ __('PIC') }}</label>
                                            <input type="text" class="form-control" wire:model='pic'>
                                            {{-- value="{{ Carbon\Carbon::parse(old('calibration_date'))->format('j F Y') }}" --}}
                                        </div>
                                        {{-- <div class="form-group mb-3">
                                            <label for="status"
                                                class="form-label text-capitalize">{{ __('status') }}</label>
                                            <select class="form-control" wire:model='status'>
                                                <option value="">Pilih salah satu...</option>
                                                <option value="Tidak Tersedia">{{ __('Tidak Tersedia') }}</option>
                                                <option value="Dipinjamkan">{{ __('Dipinjamkan') }}</option>
                                                <option value="Tersedia">{{ __('Tersedia') }}</option>
                                            </select>
                                        </div> --}}
                                        <div class="d-grid">
                                            <button type="submit"
                                                class="btn btn-success text-white">{{ __('Submit') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
