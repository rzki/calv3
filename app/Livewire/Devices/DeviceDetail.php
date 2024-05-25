<?php

namespace App\Livewire\Devices;

use App\Models\Device;
use Livewire\Component;

class DeviceDetail extends Component
{
    public Device $devices;
    // public function mount($deviceId)
    // {
    //     $this->devices = Device::where('deviceId', $deviceId)->first();
    // }
    public function render()
    {
        return view('livewire.devices.device-detail',[
            'devices' => $this->devices
        ]);
    }
}
