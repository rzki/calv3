<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-5">{{ __('Tambah Histori Pinjam') }}</h2>
                            <div class="row mb-5">
                                <div class="col">
                                    <a href="{{ route('inventories.history', $inventories->inventoryId) }}" wire:navigate
                                        class="btn btn-primary text-white"><i class="fas fa-arrow-left"></i>
                                        {{ __('Kembali') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form wire:submit='create' method="post">
                                        <div class="form-group mb-3">
                                            <label for="tanggal" class="form-label">{{ __('Tanggal') }}</label>
                                            <input type="date" name="tanggal" id="tanggal" class="form-control" wire:model='tanggal'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="kegiatan" class="form-label">{{ __('Kegiatan') }}</label>
                                            <input type="text" name="kegiatan" id="kegiatan" class="form-control" wire:model='kegiatan'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="keterangan" class="form-label">{{__('Keterangan')}}</label>
                                            <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control" wire:model='keterangan'></textarea>
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
@script
<script>
    $('#device_name').select2({
            theme: 'bootstrap-5'
        });
</script>
@endscript
