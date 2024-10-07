<?php

namespace App\Livewire\Inventories\Logs;

use App\Models\LogBook;
use Livewire\Component;
use App\Models\Inventory;
use Livewire\Attributes\Title;

class InventoryLog extends Component
{
    public $inventory, $inventoryId, $search;
    public $invLog, $deleteLog, $logId;
    protected $listeners = ['deleteConfirmed' => 'delete'];

    public $perPage = 5;
    public function mount($inventoryId)
    {
        $this->inventory = Inventory::where('inventoryId', $inventoryId)->first();
        $this->invLog = LogBook::where('inventory_id', $this->inventory->id)->with('inventories')->orderByDesc('updated_at')->first();
    }
    public function deleteConfirm($logId){
        $this->logId = $logId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $this->deleteLog = LogBook::where('logId', $this->logId)->first();
        $this->deleteLog->delete();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Log Inventaris berhasil dihapus!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('inventories.history', ['inventoryId' => $this->inventoryId], navigate:true);
    }
    #[Title('Log Inventaris')]
    public function render()
    {
        return view('livewire.inventories.logs.inventory-log',[
            'logBooks' => LogBook::searchLogByInventoryId($this->search)
            ->where('inventory_id', $this->inventory->id)
            ->paginate($this->perPage),
            'inventories' => $this->inventory
        ]);
    }
}
