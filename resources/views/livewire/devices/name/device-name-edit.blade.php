<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-5">{{ __('Edit Nama Alat') }}</h2>
                            <div class="row mb-5">
                                <div class="col">
                                    <a href="{{ route('device_name.index') }}" wire:navigate class="btn btn-primary text-white"><i class="fas fa-arrow-left"></i>
                                        Kembali</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form wire:submit='update'>
                                        <div class="form-group mb-3">
                                            <label for="nama" class="form-label">{{ __('Nama') }}</label>
                                            <input type="text" class="form-control" wire:model='nama'>
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
