<?php

namespace App\Livewire\Inventories;

use App\Models\User;
use Livewire\Component;
use App\Models\Inventory;
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
        $this->inventaris = Inventory::where('inventoryId', $this->inventoryId)->first();
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
        if($this->authorize('adminAccess', $user)){
            return view('livewire.inventories.inventory-index', [
                'inventoryIndex' => Inventory::search($this->search)
                ->paginate($this->perPage)
            ]);
        }else{
            return view('livewire.dashboard');
        }
    }
}
