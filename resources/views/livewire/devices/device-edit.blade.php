<div>
    <div class="py-4 main">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="px-0 col-12">
                    <div class="border-0 shadow card">
                        <div class="card-body">
                            <h2 class="mb-1 fs-5 fw-bold mb-5">{{ __('Update QR Alat') }}</h2>
                            <div class="row mb-5">
                                <div class="col">
                                    <a href="{{ route('devices.index') }}" wire:navigate
                                        class="btn btn-primary text-white"><i class="fas fa-arrow-left"></i>
                                        {{ __('Kembali') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <form wire:submit='update' method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="nama"
                                                        class="form-label text-capitalize">{{ __('nama') }}</label>
                                                    <div wire:ignore>
                                                        <select class="form-control" id="name_id" name="name_id">
                                                            <option value="">{{ __('Pilih salah satu...') }}</option>
                                                            @foreach ($name as $nama)
                                                            <option value="{{ $nama->id }}" {{ old('name_id', $qr->name_id) == $nama->id ? 'selected' : '' }}>
                                                                {{ $nama->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="inv_number"
                                                        class="form-label text-capitalize">{{ __('no. inventaris') }}</label>
                                                    <input type="text" class="form-control" wire:model='inv_number'>
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="serial_number"
                                                        class="form-label text-capitalize">{{ __('no. seri') }}</label>
                                                    <input type="text" class="form-control"
                                                        wire:model='serial_number'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="merk"
                                                        class="form-label text-capitalize">{{ __('merek') }}</label>
                                                    <input type="text" class="form-control" wire:model='merk'>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="tipe"
                                                        class="form-label text-capitalize">{{ __('tipe') }}</label>
                                                    <input type="text" class="form-control" wire:model='tipe'>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="lokasi"
                                                        class="form-label text-capitalize">{{ __('ruang') }}</label>
                                                    <input type="text" class="form-control" wire:model='lokasi'>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="pic"
                                                        class="form-label text-capitalize">{{ __('PIC') }}</label>
                                                    <input type="text" class="form-control" wire:model='pic'>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="rumah_sakit"
                                                        class="form-label text-capitalize">{{ __('rumah sakit') }}</label>
                                                    <div wire:ignore>
                                                        <select class="form-control" name="hospital_id" id="hospital_id">
                                                            <option value="">{{ __('Pilih salah satu...') }}</option>
                                                            @foreach ($rs as $rs)
                                                            <option value="{{ $rs->id }}" {{ old('hospital_id', $qr->hospital_id) == $rs->id ? 'selected' : '' }}>
                                                                {{ $rs->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="kalibrasi_terakhir"
                                                        class="form-label text-capitalize">{{ __('kalibrasi terakhir') }}</label>
                                                    <input type="date" class="form-control"
                                                        wire:model='kalibrasi_terakhir'
                                                        value="{{ Carbon\Carbon::parse(old('calibration_date'))->format('j F Y') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="certif_no" class="form-label text-capitalize"
                                                        wire:model='certif_no'>{{ __('no. sertifikat') }}</label>
                                                    <input type="text" name="certif_no" id="certif_no"
                                                        class="form-control" wire:model='certif_no'>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="certif_file"
                                                        class="form-label text-capitalize">{{ __('unggah sertifikat') }}</label>
                                                    <input type="file" name="certif_file" id="certif_file"
                                                        class="form-control" wire:model='certif_file'>
                                                    <span
                                                        class="form-text fst-italic">{{ __('hanya mendukung pdf dan maksimal file 1MB') }}</span>
                                                </div>
                                            </div>
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
@script
    <script>
        $(document).ready(function(){
            // Nama Alat
            $( '#name_id' ).select2({
                theme: "bootstrap-5"
            });
            $( '#name_id' ).on('change', function(e){
                var names = $(this).val();
                $wire.set('name_id', names);
            });

            // Rumah Sakit
            $( '#hospital_id' ).select2({
                theme: "bootstrap-5"
            });
            $( '#hospital_id' ).on('change', function(e){
                var names = $(this).val();
                $wire.set('hospital_id', names);
            });
        })
    </script>
@endscript
