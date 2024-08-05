<?php

namespace App\Livewire\Devices;

// use App\Models\Device;
use App\Models\User;
use Livewire\Component;
use App\Jobs\GenerateQRJob;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

class DeviceGenerate extends Component
{
    public $number;

    public function generate()
    {
        $numberOfDevices = (int) $this->number;
        if ($numberOfDevices <= 0) {
            return back()->withErrors(['number' => 'Please enter a valid number of devices.']);
        }

        for ($i = 0; $i < $numberOfDevices; $i++) {
            // Create device data
            $deviceID = Str::orderedUuid();
            $devices[] = [
                'deviceId' => $deviceID,
            ];
        }
        GenerateQRJob::dispatch($devices);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Alat berhasil ditambahkan!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 3000,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('devices.index', navigate:true);
    }
    #[Title('Generate Kode QR Alat')]
    public function render(User $user)
    {
        if($this->authorize('createDevices', $user)){
            return view('livewire.devices.device-generate');
        }
    }
}
