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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;

class DeviceEdit extends Component
{
    use WithFileUploads;

    public $alat, $namaAlat, $deviceId, $name_id, $inv_number, $merk, $tipe, $serial_number, $lokasi, $pic,  $kalibrasi_terakhir, $status;
    #[Validate('mimes:pdf|max:2048')]
    public $certif_no, $certif_file, $sertifPath;
    public $rumah_sakit, $hospital_id;
    public $url;
    public function mount($deviceId)
    {
        $this->alat = Device::where('deviceId', $deviceId)->first();
        $this->name_id = $this->alat->name_id;
        $this->inv_number = $this->alat->inv_number;
        $this->merk = $this->alat->brand;
        $this->tipe = $this->alat->type;
        $this->serial_number = $this->alat->serial_number;
        $this->lokasi = $this->alat->location;
        $this->pic = $this->alat->pic;
        $this->hospital_id = $this->alat->hospital_id;
        $this->kalibrasi_terakhir = $this->alat->calibration_date;
        $this->certif_no = $this->alat->certif_no;
        $this->status = $this->alat->status;
        $this->url = session('lastPageWithPageNumber');
    }

    public function update()
    {
        // dd($this->name_id);
        // If Sertif file exists and the user role is Teknisi
        if($this->certif_file && Auth::user()->hasRole('Teknisi')){
                $namaSertif = $this->serial_number.'.pdf';
                $this->sertifPath = 'files/pdf/sertifikat/';
                Storage::disk('public')->putFileAs($this->sertifPath, $this->certif_file, $namaSertif);
            Device::where('deviceId', $this->deviceId)->update([
                'name_id' => $this->name_id,
                'inv_number' => $this->inv_number,
                'brand' => $this->merk,
                'type' => $this->tipe,
                'serial_number' => $this->serial_number,
                'location' => $this->lokasi,
                'pic' => $this->pic,
                'hospital_id' => $this->hospital_id,
                'calibration_date' => $this->kalibrasi_terakhir,
                'next_calibration_date' => Carbon::parse($this->kalibrasi_terakhir)->addYear(),
                'certif_no' => $this->certif_no,
                'certif_file' => $this->sertifPath.$namaSertif,
                'user_id' => Auth::user()->id,
                'status' => 'Tersedia'
            ]);
        }
        // If Sertif file exists and the user role is Admin
        elseif($this->certif_file && Auth::user()->hasRole(['Superadmin','Admin'])){
                $namaSertif = $this->serial_number.'.pdf';
                $this->sertifPath = 'files/pdf/sertifikat/';
                Storage::disk('public')->putFileAs($this->sertifPath, $this->certif_file, $namaSertif);
            Device::where('deviceId', $this->deviceId)->update([
                'name_id' => $this->name_id,
                'inv_number' => $this->inv_number,
                'brand' => $this->merk,
                'type' => $this->tipe,
                'serial_number' => $this->serial_number,
                'location' => $this->lokasi,
                'pic' => $this->pic,
                'hospital_id' => $this->hospital_id,
                'calibration_date' => $this->kalibrasi_terakhir,
                'next_calibration_date' => Carbon::parse($this->kalibrasi_terakhir)->addYear(),
                'certif_no' => $this->certif_no,
                'certif_file' => $this->sertifPath.$namaSertif,
                'status' => 'Belum Tersedia'
            ]);

        }elseif(!$this->certif_file && Auth::user()->hasRole(['Superadmin','Admin'])){
            Device::where('deviceId', $this->deviceId)->update([
                'name_id' => $this->name_id,
                'inv_number' => $this->inv_number,
                'brand' => $this->merk,
                'type' => $this->tipe,
                'serial_number' => $this->serial_number,
                'location' => $this->lokasi,
                'pic' => $this->pic,
                'hospital_id' => $this->hospital_id,
                'calibration_date' => $this->kalibrasi_terakhir,
                'next_calibration_date' => Carbon::parse($this->kalibrasi_terakhir)->addYear(),
                'certif_no' => $this->certif_no,
                'status' => 'Belum Tersedia'
            ]);
        }else{
            Device::where('deviceId', $this->deviceId)->update([
                'name_id' => $this->name_id,
                'inv_number' => $this->inv_number,
                'brand' => $this->merk,
                'type' => $this->tipe,
                'serial_number' => $this->serial_number,
                'location' => $this->lokasi,
                'pic' => $this->pic,
                'hospital_id' => $this->hospital_id,
                'calibration_date' => $this->kalibrasi_terakhir,
                'next_calibration_date' => Carbon::parse($this->kalibrasi_terakhir)->addYear(),
                'certif_no' => $this->certif_no,
                'user_id' => Auth::user()->id,
                'status' => 'Belum Tersedia'
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Alat berhasil diubah!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 3000,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('devices.index',['page' => $this->url], navigate:true);
        // return $this->redirect($this->url);
    }
    #[Title('Update QR Alat')]
    #[Url(history:true)]
    public function render(User $user)
    {
        if($this->authorize('editDevices', $user)){
            return view('livewire.devices.device-edit', [
                'qr' => $this->alat,
                'name' => DeviceName::all(),
                'rs' => Hospital::all()
            ]);
        }
    }
}
