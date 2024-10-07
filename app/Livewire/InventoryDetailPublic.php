<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Inventory;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class InventoryDetailPublic extends Component
{
    public Inventory $inventory;
    public function mount($inventoryId)
    {
        $this->inventory = Inventory::where('inventoryId', $inventoryId)->first();
    }
    #[Title('Detail Inventaris')]
    #[Layout('components.layouts.public')]
    public function render()
    {
        return view('livewire.inventory-detail-public',[
            'inv' => $this->inventory
        ]);
    }
}
