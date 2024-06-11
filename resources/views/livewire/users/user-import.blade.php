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
                                        <div x-data="{uploading: false, progress: 0}" x-on:livewire-upload-start="uploading:true" x-on:livewire-upload-finish="uploading:false" x-on:livewire-upload-cancel="uploading:false" x-on:livewire-upload-error="uploading:false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <div class="form-group mb-3">
                                                <label for="users" class="form-label">{{ __('Pilih File') }}</label>
                                                <input type="file" class="form-control" wire:model='users' name="users" id="users">
                                                <p class="form-text">{{ __('Hanya mendukung file excel') }}</p>
                                            </div>
                                            <div class="progress-bar" x-show="uploading">
                                                <progress max="100" x-bind:value="progress"></progress>
                                            </div>
                                            <div class="upload mb-3 justify-content-center text-center" wire:loading wire:target='users'>{{ __('Sedang mengunggah...') }}</div>
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-success text-white">{{ __('Submit')
                                                    }}</button>
                                            </div>
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
