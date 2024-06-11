<?php

namespace App\Livewire\Inventories\Logs;

use App\Models\User;
use App\Models\LogBook;
use Livewire\Component;
use App\Models\Inventory;
use Livewire\Attributes\Title;

class InventoryEditLog extends Component
{
    public $inventories, $inventoryId, $logBook, $logId, $no_inv, $mulai_pinjam, $selesai_pinjam, $lokasi_pinjam, $pic, $status;
    public function mount($inventoryId, $logId)
    {
        $this->inventories = Inventory::with('devnames')->where('inventoryId', $inventoryId)->first();
        $this->logBook = LogBook::with('inventories')->where('logId', $logId)->first();
        $this->mulai_pinjam = $this->logBook->tanggal_mulai_pinjam;
        $this->selesai_pinjam = $this->logBook->tanggal_selesai_pinjam;
        $this->lokasi_pinjam = $this->logBook->lokasi_pinjam;
        $this->pic = $this->logBook->pic_pinjam;
    }
    public function updateLog()
    {
        LogBook::where('logId', $this->logId)->update([
            'tanggal_mulai_pinjam' => $this->mulai_pinjam,
            'tanggal_selesai_pinjam' => $this->selesai_pinjam,
            'lokasi_pinjam' => $this->lokasi_pinjam,
            'pic_pinjam' => $this->pic,
            'status' => 'Dipinjamkan',
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Log Pinjam berhasil diperbarui!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3000,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('inventories.detail', ['inventoryId' => $this->inventoryId], navigate: true);
    }

    #[Title('Update Log Inventaris')]
    public function render(User $user)
    {
        if ($this->authorize('adminAccess', $user)) {
            return view('livewire.inventories.logs.inventory-edit-log', [
                'invEditLog' => $this->inventories,
                'logEdit' => $this->logBook,
            ]);
        } else {
            return view('livewire.dashboard');
        }
    }
}
