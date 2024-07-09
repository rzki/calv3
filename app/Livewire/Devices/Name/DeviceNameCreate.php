<?php

namespace App\Livewire\Devices\Name;

use Livewire\Component;
use App\Models\DeviceName;
use App\Models\User;
use Livewire\Attributes\Title;

class DeviceNameCreate extends Component
{
    public $nama;
    public function create()
    {
        DeviceName::create([
            'name' => $this->nama,
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Nama Alat berhasil ditambahkan!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3000,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('device_name.index', navigate: true);
    }
    #[Title('Tambah Nama Alat')]
    public function render(User $user)
    {
        if($this->authorize('device_names', $user)){
            return view('livewire.devices.name.device-name-create');
        }
    }
}
