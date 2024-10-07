<?php

namespace App\Livewire\Inventories\Histories;

use Livewire\Component;
use App\Models\Inventory;
use Illuminate\Support\Str;
use App\Models\InventoryHistory;
use Livewire\Attributes\Title;

class InventoryHistoryCreate extends Component
{
    public $inventories, $inventoryId, $tanggal, $kegiatan, $keterangan;
    public function mount($inventoryId)
    {
        $this->inventories = Inventory::where('inventoryId', $inventoryId)->first();
    }
    public function create()
    {
        InventoryHistory::create([
            'historyId' => Str::orderedUuid(),
            'inv_id' => $this->inventories->id,
            'date' => $this->tanggal,
            'activity' => $this->kegiatan,
            'description' => $this->keterangan
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Histori Inventaris berhasil dibuat!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('inventories.history', ['inventoryId' => $this->inventories->inventoryId], navigate:true);
    }
    #[Title('Tambah Histori Inventaris')]
    public function render()
    {
        return view('livewire.inventories.histories.inventory-history-create',[
            'inventories' => $this->inventories
        ]
    );
    }
}
