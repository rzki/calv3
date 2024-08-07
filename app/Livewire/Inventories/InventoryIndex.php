<?php

namespace App\Livewire\Inventories;

use App\Models\User;
use App\Models\Device;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

class InventoryIndex extends Component
{
    use WithPagination;
    public $inventaris, $inventoryId;
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
    public function deleteConfirm($inventoryId){
        $this->inventoryId = $inventoryId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $this->inventaris = Device::where('deviceId', $this->inventoryId)->first();
        $this->inventaris->delete();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Inventaris berhasil dihapus!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('inventories.index', navigate:true);
    }
    #[Title('Semua Inventaris')]
    public function render(User $user)
    {
        // if(Auth::user()->hasRole('Teknisi')){
        //     abort(403);
        // } else {
        return view('livewire.inventories.inventory-index', [
            'inventoryIndex' => Device::search($this->search)
            ->paginate($this->perPage)
        ]);
        // }
    }
}
