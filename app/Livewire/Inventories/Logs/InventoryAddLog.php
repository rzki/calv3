<?php

namespace App\Livewire\Inventories\Logs;

use Carbon\Carbon;
use App\Models\User;
use App\Models\LogBook;
use Livewire\Component;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

class InventoryAddLog extends Component
{
    public $inventories, $inventoryId, $no_inv, $mulai_pinjam, $selesai_pinjam, $lokasi_pinjam, $pic, $status;
    public function mount($inventoryId)
    {
        $this->inventories = Inventory::with('devnames')->where('inventoryId', $inventoryId)->first();
    }
    public function addLog()
    {
        LogBook::create([
            'logId' => Str::orderedUuid(),
            'inventory_id' => $this->inventories->id,
            'tanggal_mulai_pinjam' => $this->mulai_pinjam,
            'tanggal_selesai_pinjam' => $this->selesai_pinjam,
            'lokasi_pinjam' => $this->lokasi_pinjam,
            'pic_pinjam' => $this->pic,
            'status' => 'Dipinjamkan',
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Log Pinjam berhasil ditambahkan!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3000,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('inventories.detail', ['inventoryId' => $this->inventoryId], navigate: true);
    }

    #[Title('Tambah Log Inventaris')]
    public function render(User $user)
    {
        if ($this->authorize('adminAccess', $user)) {
            return view('livewire.inventories.logs.inventory-add-log', [
                'invAddLog' => $this->inventories,
            ]);
        } else {
            return view('livewire.dashboard');
        }
    }
}
