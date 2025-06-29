<?php

namespace App\Livewire\Inventories;

use App\Models\Device;
use App\Models\LogBook;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

class InventoryDetail extends Component
{
    use WithPagination;
    public $inventories, $inventoryId, $latestLog, $logbook, $logId;
    public $searchByInventoryId, $sortBy='created_at', $sortDir='ASC', $perPage=5;
    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function mount($inventoryId)
    {
        $this->inventories = Device::where('deviceId', $inventoryId)->first();
        $this->latestLog = LogBook::where('inventory_id', $this->inventories->id)->with('inventories')->orderByDesc('created_at')->first();
    }

    public function sort($sortByField)
    {
        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sortByField;
    }
    public function deleteConfirm($logId){
        $this->logId = $logId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $this->logbook = LogBook::where('logId', $this->logId)->first();
        $this->logbook->delete();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Log Pinjam berhasil dihapus!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('inventories.detail', ['inventoryId' => $this->inventoryId], navigate:true);
    }
    #[Title('Detail Inventaris')]
    public function render()
    {
        // dd($this->inventories);
        return view('livewire.inventories.inventory-detail',[
            'latest' => $this->latestLog,
            'invDetail' => $this->inventories,
            'logDetail' => LogBook::searchLogByInventoryId($this->searchByInventoryId)
            ->where('inventory_id', $this->inventories->id)
            ->paginate($this->perPage)
        ]);
    }
}
