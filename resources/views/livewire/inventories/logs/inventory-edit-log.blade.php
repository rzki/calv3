<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-5">{{ __('Update Log Pinjam') }}</h2>
                            <div class="row mb-5">
                                <div class="col">
                                    <a href="{{ route('inventories.logs', $invEditLog->inventoryId) }}" wire:navigate
                                        class="btn btn-primary text-white"><i class="fas fa-arrow-left"></i>
                                        {{ __('Kembali') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form wire:submit='updateLog' method="post">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="aksesoris"
                                                        class="form-label text-capitalize">{{ __('tanggal') }}</label>
                                                    <input type="date" name="tanggal"
                                                        id="tanggal" class="form-control"
                                                        wire:model='tanggal'>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="aksesoris"
                                                        class="form-label text-capitalize">{{ __('aksesoris') }}</label>
                                                    <input type="text" name="aksesoris"
                                                        id="aksesoris" class="form-control"
                                                        wire:model='aksesoris'>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="tanggal_mulai_pinjam"
                                                        class="form-label text-capitalize">{{ __('mulai pinjam') }}</label>
                                                    <input type="date" name="tanggal_mulai_pinjam"
                                                        id="tanggal_mulai_pinjam" class="form-control"
                                                        wire:model='mulai_pinjam'>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="kondisi_awal"
                                                        class="form-label text-capitalize">{{ __('kondisi awal') }}</label>
                                                    <input type="text" name="kondisi_awal"
                                                        id="kondisi_awal" class="form-control"
                                                        wire:model='kondisi_awal'>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="tanggal_selesai_pinjam"
                                                        class="form-label text-capitalize">{{ __('selesai pinjam') }}</label>
                                                    <input type="date" name="tanggal_selesai_pinjam"
                                                        id="tanggal_selesai_pinjam" class="form-control"
                                                        wire:model='selesai_pinjam'>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="kondisi_akhir"
                                                        class="form-label text-capitalize">{{ __('kondisi akhir') }}</label>
                                                    <input type="text" name="kondisi_akhir"
                                                        id="kondisi_akhir" class="form-control"
                                                        wire:model='kondisi_akhir'>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="lokasi"
                                                        class="form-label text-capitalize">{{ __('lokasi pinjam') }}</label>
                                                    <input type="text" class="form-control" wire:model='lokasi_pinjam'>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="pic"
                                                        class="form-label text-capitalize">{{ __('PIC') }}</label>
                                                    <input type="text" class="form-control" wire:model='pic_pinjam'>
                                                </div>
                                            </div>
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
