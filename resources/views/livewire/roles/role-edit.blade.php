<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-5">{{ __('Update Role') }}</h2>
                            <div class="row mb-5">
                                <div class="col">
                                    <a href="{{ route('roles.index') }}" class="btn btn-primary text-white"
                                        wire:navigate><i class="fas fa-arrow-left"></i>
                                        {{ __('Kembali') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form wire:submit='update' method="post">
                                        <div class="form-group mb-4">
                                            <label for="name" class="form-label">{{ __('Nama') }}</label>
                                            <input type="text" class="form-control" wire:model='name'>
                                        </div>
                                        {{-- <h5 class="mb-3">{{ __('Tambahkan Permission ke Role') }}</h5>
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">{{ __('Permissions') }}</label>
                                            <select name="permission_list" id="permission_list" class="form-control"
                                                wire:model='permission_list'>
                                                <option value="">{{ __('Pilih salah satu...') }}</option>
                                                @foreach ($allPermissions as $permission)
                                                    <option value="{{ $permission->id }}">{{ $permission->name }}
                                                    </option>
                                                @endforeach
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
