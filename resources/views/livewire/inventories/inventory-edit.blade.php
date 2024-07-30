<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-5">{{ __('Tambah Inventaris') }}</h2>
                            <div class="row mb-5">
                                <div class="col">
                                    <a href="{{ route('inventories.index') }}" wire:navigate
                                        class="btn btn-primary text-white"><i class="fas fa-arrow-left"></i>
                                        {{ __('Kembali') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form wire:submit='update' method="post">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group mb-3">
                                                    <label for="nama"
                                                        class="form-label text-capitalize">{{ __('nama alat') }}</label>
                                                    <select type="text" class="form-control" wire:model='nama'>
                                                        <option value="">{{ __('Pilih salah satu...') }}</option>
                                                        @foreach ($namaAlat as $nama)
                                                            <option value="{{ $nama->id }}">{{ $nama->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group mb-3">
                                                    <label for="merk"
                                                        class="form-label text-capitalize">{{ __('merk') }}</label>
                                                    <input type="text" class="form-control" wire:model='merk'>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group mb-3">
                                                    <label for="tipe"
                                                        class="form-label text-capitalize">{{ __('tipe') }}</label>
                                                    <input type="text" class="form-control" wire:model='tipe'>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group mb-3">
                                                    <label for="sn"
                                                        class="form-label text-capitalize">{{ __('serial number') }}</label>
                                                    <input type="text" class="form-control" wire:model='sn'>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="tahun"
                                                        class="form-label text-capitalize">{{ __('tahun pengadaan') }}</label>
                                                    <input type="text" class="form-control" wire:model='tahun'>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="no_inv"
                                                        class="form-label text-capitalize">{{ __('no. inventaris') }}</label>
                                                    <input type="text" class="form-control" wire:model='no_inv'
                                                        value="MJG.INV.">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="lokasi"
                                                        class="form-label text-capitalize">{{ __('lokasi') }}</label>
                                                    <input type="text" class="form-control" wire:model='lokasi'>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="kalibrasi_terakhir"
                                                        class="form-label text-capitalize">{{ __('kalibrasi terakhir') }}</label>
                                                    <input type="date" class="form-control"
                                                        wire:model='kalibrasi_terakhir'>
                                                    {{-- value="{{ Carbon\Carbon::parse(old('calibration_date'))->format('j F Y') }}" --}}
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="pic"
                                                        class="form-label text-capitalize">{{ __('PIC') }}</label>
                                                    <input type="text" class="form-control" wire:model='pic'>
                                                    {{-- value="{{ Carbon\Carbon::parse(old('calibration_date'))->format('j F Y') }}" --}}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group mb-3">
                                            <label for="nama"
                                                class="form-label text-capitalize">{{ __('nama alat') }}</label>
                                            <select type="text" class="form-control" wire:model='nama'>
                                                <option value="">{{ __('Pilih salah satu...') }}</option>
                                                @foreach ($namaAlat as $nama)
                                                    <option value="{{ $nama->id }}" {{ old('device_name', $invEdit->device_name) == $nama->id ? 'selected' : '' }}>{{ $nama->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="merk"
                                                class="form-label text-capitalize">{{ __('merk') }}</label>
                                            <input type="text" class="form-control" wire:model='merk'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="tipe"
                                                class="form-label text-capitalize">{{ __('tipe') }}</label>
                                            <input type="text" class="form-control" wire:model='tipe'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="sn"
                                                class="form-label text-capitalize">{{ __('serial number') }}</label>
                                            <input type="text" class="form-control" wire:model='sn'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="tahun"
                                                class="form-label text-capitalize">{{ __('tahun pengadaan') }}</label>
                                            <input type="text" class="form-control" wire:model='tahun'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="no_inv"
                                                class="form-label text-capitalize">{{ __('no. inventaris') }}</label>
                                            <input type="text" class="form-control" wire:model='no_inv'
                                                value="MJG.INV.">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="lokasi"
                                                class="form-label text-capitalize">{{ __('lokasi') }}</label>
                                            <input type="text" class="form-control" wire:model='lokasi'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="kalibrasi_terakhir"
                                                class="form-label text-capitalize">{{ __('kalibrasi terakhir') }}</label>
                                            <input type="date" class="form-control" wire:model='kalibrasi_terakhir'
                                            value="{{ Carbon\Carbon::parse(old('calibration_date'))->format('j F Y')}}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="pic"
                                                class="form-label text-uppercase">{{ __('pic') }}</label>
                                            <input type="text" class="form-control" wire:model='pic'>
                                        </div>
                                        <div class="form-group mb-3">
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
