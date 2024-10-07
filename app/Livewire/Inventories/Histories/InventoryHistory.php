<?php

namespace App\Livewire\Inventories\Histories;

use Livewire\Component;
use App\Models\Inventory;
use Livewire\Attributes\Title;
use App\Models\InventoryHistory as History;

class InventoryHistory extends Component
{
    public $inventory, $inventoryId;
    public $invHistory, $deleteHistory, $historyId;
    protected $listeners = ['deleteConfirmed' => 'delete'];

    public $perPage = 5;
    public function mount($inventoryId)
    {
        $this->inventory = Inventory::where('inventoryId', $inventoryId)->first();
        $this->invHistory = History::where('inv_id', $this->inventory->id)->with('inventories')->orderByDesc('updated_at')->first();
    }
    public function deleteConfirm($historyId){
        $this->historyId = $historyId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $this->deleteHistory = History::where('historyId', $this->historyId)->first();
        $this->deleteHistory->delete();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Histori Inventaris berhasil dihapus!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('inventories.history', ['inventoryId' => $this->inventoryId], navigate:true);
    }
    #[Title('Histori Inventaris')]
    public function render()
    {

        return view('livewire.inventories.histories.inventory-history', [
            'histories' => History::where('inv_id', $this->inventory->id)
                            ->orderByDesc('updated_at')
                            ->paginate($this->perPage),
            'inventories' => $this->inventory
        ]);
    }
}
