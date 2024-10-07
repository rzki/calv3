<?php

namespace App\Livewire\Inventories\Histories;

use Livewire\Component;
use App\Models\Inventory;
use App\Models\InventoryHistory;
use Livewire\Attributes\Title;

class InventoryHistoryEdit extends Component
{
    public $inventory, $history, $inventoryId, $historyId, $tanggal, $kegiatan, $keterangan;

    public function mount($inventoryId, $historyId)
    {
        $this->inventory = Inventory::where('inventoryId', $inventoryId)->first();
        $this->history = InventoryHistory::with('inventories')->where('historyId', $historyId)->first();
        $this->tanggal = $this->history->date;
        $this->kegiatan = $this->history->activity;
        $this->keterangan = $this->history->description;
    }
    public function update()
    {
        InventoryHistory::where('historyId', $this->historyId)->update([
            'date' => $this->tanggal,
            'activity' => $this->kegiatan,
            'description' => $this->keterangan
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Histori Inventaris berhasil diubah!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('inventories.history', ['inventoryId' => $this->inventoryId], navigate:true);
    }
    #[Title('Ubah Histori Pinjam')]
    public function render()
    {
        return view('livewire.inventories.histories.inventory-history-edit',[
            'inventories' => $this->inventory,
            'invHistory' => $this->history
        ]);
    }
}
