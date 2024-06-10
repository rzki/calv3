<?php

namespace App\Livewire\Devices;

use App\Models\Device;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class DeviceDetail extends Component
{
    public Device $alat;
    public function mount($deviceId)
    {
        $this->alat = Device::where('deviceId', $deviceId)->first();
    }
    #[Title('Detail Alat')]
    #[Layout('components.layouts.public')]
    public function render()
    {
        return view('livewire.devices.device-detail',[
            'qr' => $this->alat
        ]);
    }
}
