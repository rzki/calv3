<?php

namespace App\Livewire\Inventories;

use App\Models\LogBook;
use Livewire\Component;
use App\Models\Inventory;
use Livewire\Attributes\Title;

class InventoryDetail extends Component
{
    public $inventories, $inventoryId, $logbook;
    public function mount($inventoryId)
    {
        $this->inventories = Inventory::where('inventoryId', $inventoryId)->first();
        $this->logbook = LogBook::where('inventory_id', $this->inventories->id)->with('inventories')->get();
    }

    #[Title('Detail Inventaris')]
    public function render()
    {
        return view('livewire.inventories.inventory-detail',[
            'invDetail' => $this->inventories,
            'logDetail' => $this->logbook
        ]);
    }
}
