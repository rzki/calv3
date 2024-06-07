<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-5">{{ __('Import User') }}</h2>
                            <div class="row mb-5">
                                <div class="col">
                                    <a href="{{ route('users.index') }}" class="btn btn-primary text-white"
                                        wire:navigate><i class="fas fa-arrow-left"></i>
                                        {{ __('Kembali') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form wire:submit='import' method="post" enctype="multipart/form-data">
                                        <div class="form-group mb-3">
                                            <label for="users" class="form-label">{{ __('Pilih File') }}</label>
                                            <input type="file" class="form-control" wire:model='users' name="users" id="users">
                                            <p class="form-text">{{ __('Hanya mendukung file excel') }}</p>
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
