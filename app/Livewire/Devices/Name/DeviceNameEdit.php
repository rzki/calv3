<?php

namespace App\Livewire\Devices\Name;

use App\Models\User;
use Livewire\Component;
use App\Models\DeviceName;
use Livewire\Attributes\Title;

class DeviceNameEdit extends Component
{
    public $devnames, $nameId, $nama;
    public function mount($nameId)
    {
        $this->devnames = DeviceName::where('id', $nameId)->first();
        $this->nama = $this->devnames->name;
    }
    public function update()
    {
        DeviceName::where('id', $this->nameId)->update([
            'name' => $this->nama
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Nama Alat berhasil diperbarui!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 3000,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('device_name.index', navigate:true);
    }
    #[Title('Update Nama Alat')]
    public function render(User $user)
    {
        if($this->authorize('adminAccess', $user)){
            return view('livewire.devices.name.device-name-edit');
        }
    }
}
