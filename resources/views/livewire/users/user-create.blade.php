<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-5">{{ __('Tambah User') }}</h2>
                            <div class="row mb-5">
                                <div class="col">
                                    <a href="{{ route('users.index') }}" class="btn btn-primary text-white"
                                        wire:navigate><i class="fas fa-arrow-left"></i>
                                        {{ __('Kembali') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form wire:submit='create' method="post">
                                        <div class="form-group mb-3">
                                            <label for="nama" class="form-label">{{ __('Nama') }}</label>
                                            <input type="text" class="form-control" wire:model='nama'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="email" class="form-label">{{ __('Email') }}</label>
                                            <input type="text" class="form-control" wire:model='email'>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="roles" class="form-label">{{ __('Role') }}</label>
                                            <select class="form-control" wire:model='roles'>
                                                <option value="">{{ __('Pilih salah satu...') }}</option>
                                                @foreach ($role as $r)
                                                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="hospitals" class="form-label hospitals">{{ __('Rumah Sakit') }}</label>
                                            <select name="hospitals" id="hospitals" class="form-control" wire:model='rs'>
                                                <option value="">{{ __('Pilih salah satu...') }}</option>
                                                @foreach ($hospital as $rs)
                                                    <option value="{{ $rs->id }}">{{ $rs->name }}</option>
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
