<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-5">{{ __('Update QR Alat') }}</h2>
                            <div class="row mb-5">
                                <div class="col">
                                    <a href="{{ route('devices.index') }}" wire:navigate class="btn btn-primary text-white"><i
                                            class="fas fa-arrow-left"></i>
                                        {{ __('Kembali') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form wire:submit='update' method="post">
                                        <div class="form-group mb-3">
                                            <label for="nama" class="form-label text-capitalize">{{ __('nama') }}</label>
                                            <select type="text" class="form-control" wire:model='nama'>
                                                <option value="">{{ __('Pilih salah satu...') }}</option>
                                                @foreach ($name as $nama)
                                                    <option value="{{ $nama->id }}" {{ old('name_id', $qr->name_id) == $nama->id ? 'selected' : '' }}>{{ $nama->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="merk" class="form-label text-capitalize">{{ __('merk') }}</label>
                                            <input type="text" class="form-control" wire:model='merk'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="tipe" class="form-label text-capitalize">{{ __('tipe') }}</label>
                                            <input type="text" class="form-control" wire:model='tipe'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="serial_number" class="form-label text-capitalize">{{ __('serial number') }}</label>
                                            <input type="text" class="form-control" wire:model='serial_number'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="lokasi" class="form-label text-capitalize">{{ __('lokasi') }}</label>
                                            <input type="text" class="form-control" wire:model='lokasi'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="rumah_sakit" class="form-label text-capitalize">{{ __('rumah sakit') }}</label>
                                            <select class="form-control" wire:model='rumah_sakit_id'>
                                                <option value="">{{ __('Pilih salah satu...') }}</option>
                                                @foreach ($rs as $rs)
                                                    <option value="{{ $rs->id }}">{{ $rs->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="kalibrasi_terakhir" class="form-label text-capitalize">{{ __('kalibrasi terakhir') }}</label>
                                            <input type="date" class="form-control" wire:model='kalibrasi_terakhir' value="{{ Carbon\Carbon::parse(old('calibration_date'))->format('j F Y') }}">
                                        </div>
                                        {{-- <div class="form-group mb-3">
                                            <label for="status" class="form-label text-capitalize">{{ __('status') }}</label>
                                            <select class="form-control" wire:model='status'>
                                                <option value="">{{ __('Pilih salah satu...') }}</option>
                                                <option value="Tidak Tersedia" {{ old('status', $qr->status) === 'Tidak Tersedia' ? 'selected' : '' }}>{{ __('Tidak Tersedia') }}</option>
                                                <option value="Tersedia" {{ old('status', $qr->status) === 'Tersedia' ? 'selected' : '' }}>{{ __('Tersedia') }}</option>
                                            </select>
                                        </div> --}}
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-success text-white">{{ __('Submit') }}</button>
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
