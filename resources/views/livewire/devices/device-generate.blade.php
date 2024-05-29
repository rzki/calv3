<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-5">{{ __('Tambah Alat') }}</h2>
                            <div class="row mb-5">
                                <div class="col">
                                    <a href="{{ route('devices.index') }}" class="btn btn-primary text-white"><i class="fas fa-arrow-left"></i> {{ __('Kembali') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form wire:submit='generate'>
                                        <div class="form-group mb-3">
                                            <label for="number" class="form-label">{{ __('Jumlah QR yang ingin digenerate') }}</label>
                                            <input type="number" name="number" id="number" class="form-control" max="1000" min="1" wire:model='number'>
                                            <span class="form-text">{{ __('(Max. 1000)') }}</span>
                                        </div>
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
