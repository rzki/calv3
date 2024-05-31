<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-5">{{ __('Tambah Alat Rumah Sakit') }}</h2>
                            <div class="row mb-5">
                                <div class="col">
                                    <a href="{{ route('hospitals.detail', $hospitals->hospitalId) }}" class="btn btn-primary text-white"><i
                                            class="fas fa-arrow-left"></i> {{ __('Kembali') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form wire:submit='addDevice'>
                                        <div class="form-group mb-3">
                                            <label for="number" class="form-label">{{ __('Jumlah QR yang ingin
                                                digenerate') }}</label>
                                            <select name="device_id" id="device_id" class="form-control" wire:model='device_id'>
                                                <option value="">{{ __('Pilih salah satu...') }}</option>
                                                @foreach ($deviceAdd as $dev)
                                                    <option value="{{ $dev->id }}">{{ $dev->names->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-success text-white">{{ __('Submit')
                                                }}</button>
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
