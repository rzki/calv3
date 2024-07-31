<?php

namespace App\Livewire\Devices\Name;

use App\Models\User;
use Livewire\Component;
use App\Models\DeviceName;
use Livewire\Attributes\Title;

class DeviceNameIndex extends Component
{
    public $nameId;
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

    public function deleteConfirm($nameId){
        $this->nameId = $nameId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $devnames = DeviceName::where('id', $this->nameId)->first();
        $devnames->delete();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Nama Alat berhasil dihapus!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('device_name.index', navigate:true);
    }

    #[Title('Semua Nama Alat')]
    public function render(User $user)
    {
        if($this->authorize('adminAccess', $user)){
            return view('livewire.devices.name.device-name-index',[
                'devnames' => DeviceName::search($this->search)
                ->orderBy($this->sortBy,$this->sortDir)
                ->paginate($this->perPage)
            ]);
        }else{
            abort(403);
        };
    }
}
