<?php

namespace App\Livewire\Hospitals\Devices;

use App\Models\User;
use App\Models\Device;
use Livewire\Component;
use App\Models\Hospital;
use Livewire\Attributes\Title;

class HospitalAddDevice extends Component
{
    public $hospitals, $hospitalId, $devices, $device_id;
    public function mount($hospitalId)
    {
        $this->hospitals = Hospital::where('hospitalId', $hospitalId)->first();
        $this->devices = Device::get();
    }
    public function addDevice()
    {
        Device::where('id', $this->device_id)->update([
            'hospital_id' => $this->hospitals->id,
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Alat berhasil ditambahkan!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3000,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('hospitals.detail', ['hospitalId' => $this->hospitalId], navigate: true);
    }
    #[Title('Tambah Alat Rumah Sakit')]
    public function render(User $user)
    {
        if ($this->authorize('adminAccess', $user)) {
            return view('livewire.hospitals.devices.device-add', [
                'hospitals' => $this->hospitals,
                'deviceAdd' => Device::get(),
            ]);
        }else{
            return view('livewire.dashboard');
        }
    }
}
