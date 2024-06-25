<?php

namespace App\Livewire\Devices;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Device;
use Livewire\Component;
use App\Models\Hospital;
use App\Models\DeviceName;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

class DeviceEdit extends Component
{
    use WithFileUploads;

    public $alat, $namaAlat, $deviceId, $nama, $inv_number, $merk, $tipe, $serial_number, $lokasi, $pic,  $kalibrasi_terakhir, $status;
    #[Validate('mimes:pdf|max:2048')]
    public $certif_no, $certif_file, $sertifPath;
    public $rumah_sakit, $rumah_sakit_id;
    public function mount($deviceId)
    {
        $this->alat = Device::where('deviceId', $deviceId)->first();
        $this->rumah_sakit = Hospital::get();
        $this->namaAlat = DeviceName::all();
        $this->nama = $this->alat->name_id;
        $this->inv_number = $this->alat->inv_number;
        $this->merk = $this->alat->brand;
        $this->tipe = $this->alat->type;
        $this->serial_number = $this->alat->serial_number;
        $this->lokasi = $this->alat->location;
        $this->pic = $this->alat->pic;
        $this->rumah_sakit_id = $this->alat->hospital_id;
        $this->kalibrasi_terakhir = $this->alat->calibration_date;
        $this->certif_no = $this->alat->certif_no;
        $this->certif_file = $this->alat->certif_file;
        $this->status = $this->alat->status;
    }

    public function update()
    {

        $namaSertif = $this->certif_no.'.pdf';
        $this->sertifPath = 'files/pdf/sertifikat/';
        Storage::disk('public')->putFileAs($this->sertifPath, $this->certif_file, $namaSertif);

        Device::where('deviceId', $this->deviceId)->update([
            'name_id' => $this->nama,
            'inv_number' => $this->inv_number,
            'brand' => $this->merk,
            'type' => $this->tipe,
            'serial_number' => $this->serial_number,
            'location' => $this->lokasi,
            'pic' => $this->pic,
            'hospital_id' => $this->rumah_sakit_id,
            'calibration_date' => $this->kalibrasi_terakhir,
            'next_calibration_date' => Carbon::parse($this->kalibrasi_terakhir)->addYear(),
            'certif_no' => $this->certif_no,
            'certif_file' => $this->sertifPath.$namaSertif,
            'status' => 'Tersedia',
            'user_id' => auth()->user()->id
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Alat berhasil diperbarui!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 3000,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('devices.index', navigate:true);
    }
    #[Title('Update QR Alat')]
    public function render(User $user)
    {
        if($this->authorize('devices', $user)){
            return view('livewire.devices.device-edit', [
                'qr' => $this->alat,
                'name' => $this->namaAlat,
                'rs' => $this->rumah_sakit
            ]);
        }
    }
}
