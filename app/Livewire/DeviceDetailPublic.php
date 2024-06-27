<?php

namespace App\Livewire;

use App\Models\Device;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class DeviceDetailPublic extends Component
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
        return view('livewire.device-detail-public',[
            'qr' => $this->alat
        ]);
    }
}
