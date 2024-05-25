<?php

namespace App\Livewire\Devices;

use App\Models\Device;
use Livewire\Component;
use Livewire\Attributes\Title;

class DeviceIndex extends Component
{
    public $deviceId;
    public $search, $sortBy='created_at', $sortDir='ASC', $perPage=5;
    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function sort($sortByField)
    {
        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sortByField;
    }

    public function deleteConfirm($deviceId){
        $this->deviceId = $deviceId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $devices = Device::where('deviceId', $this->deviceId)->first();
        $devices->delete();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Alat berhasil dihapus!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('devices.index', navigate:true);
    }
    #[Title('Semua Alat')]
    public function render()
    {
        return view('livewire.devices.device-index',[
            'devices' => Device::search($this->search)
            ->orderBy($this->sortBy,$this->sortDir)
            ->paginate($this->perPage)
        ]);
    }
}
