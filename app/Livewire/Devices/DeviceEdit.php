<?php

namespace App\Livewire\Devices;

use Carbon\Carbon;
use App\Models\Device;
use Livewire\Component;
use App\Models\Hospital;
use App\Models\DeviceName;

class DeviceEdit extends Component
{
    public $alat, $namaAlat, $deviceId, $nama, $merk, $tipe, $serial_number, $lokasi,  $kalibrasi_terakhir, $status;
    public $rumah_sakit, $rumah_sakit_id;
    public function mount($deviceId)
    {
        $this->alat = Device::where('deviceId', $deviceId)->first();
        $this->rumah_sakit = Hospital::get();
        $this->namaAlat = DeviceName::all();
        $this->nama = $this->alat->name_id;
        $this->merk = $this->alat->brand;
        $this->tipe = $this->alat->type;
        $this->serial_number = $this->alat->serial_number;
        $this->lokasi = $this->alat->location;
        $this->rumah_sakit_id = $this->alat->hospital_id;
        $this->kalibrasi_terakhir = $this->alat->calibration_date;
        $this->status = $this->alat->status;
    }

    public function update()
    {
        Device::where('deviceId', $this->deviceId)->update([
            'name_id' => $this->nama,
            'brand' => $this->merk,
            'type' => $this->tipe,
            'serial_number' => $this->serial_number,
            'location' => $this->lokasi,
            'hospital_id' => $this->rumah_sakit_id,
            'calibration_date' => $this->kalibrasi_terakhir,
            'next_calibration_date' => Carbon::parse($this->kalibrasi_terakhir)->addYear(),
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
    public function render()
    {
        return view('livewire.devices.device-edit', [
            'qr' => $this->alat,
            'name' => $this->namaAlat,
            'rs' => $this->rumah_sakit
        ]);
    }
}
