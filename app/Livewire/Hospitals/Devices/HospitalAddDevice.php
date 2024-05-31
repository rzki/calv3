<?php

namespace App\Livewire\Hospitals\Devices;

use App\Models\Device;
use Livewire\Component;
use App\Models\Hospital;

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
            'hospital_id' => $this->hospitals->id
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Alat berhasil ditambahkan!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 3000,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('hospitals.detail',['hospitalId' => $this->hospitalId], navigate:true);
    }
    public function render()
    {
        return view('livewire.hospitals.devices.device-add', [
            'hospitals' => $this->hospitals,
            'deviceAdd' => Device::get()
        ]);
    }
}
