<?php

namespace App\Livewire\Devices;

use App\Models\Device;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DeviceDetail extends Component
{
    public Device $alat;
    public function mount($deviceId)
    {
        $this->alat = Device::where('deviceId', $deviceId)->first();
    }
    #[Layout('components.layouts.public')]
    public function render()
    {
        return view('livewire.devices.device-detail',[
            'qr' => $this->alat
        ]);
    }
}
