<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-5">{{ __('Tambah Data Pelanggan') }}</h2>
                            <div class="row mb-5">
                                <div class="col">
                                    <a href="{{ route('hospitals.index') }}" wire:navigate
                                        class="btn btn-primary text-white"><i class="fas fa-arrow-left"></i>
                                        {{ __('Kembali') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form wire:submit='create' method="post">
                                        <div class="form-group mb-3">
                                            <label for="name"
                                                class="form-label text-capitalize">{{ __('nama Data Pelanggan') }}</label>
                                            <input type="text" class="form-control" wire:model='name'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="phone_number"
                                                class="form-label text-capitalize">{{ __('no telepon Data Pelanggan') }}</label>
                                            <input type="text" class="form-control" wire:model='phone_number'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="address"
                                                class="form-label text-capitalize">{{ __('alamat') }}</label>
                                            <textarea type="text" class="form-control" wire:model='address'></textarea>
                                        </div>
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
