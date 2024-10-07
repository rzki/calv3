<?php

namespace App\Livewire\Inventories\Logs;

use App\Models\Device;
use App\Models\User;
use App\Models\LogBook;
use Livewire\Component;
use App\Models\Inventory;
use Livewire\Attributes\Title;

class InventoryEditLog extends Component
{
    public $inventories, $inventoryId, $logBook, $logId,  $tanggal, $aksesoris, $kondisi_awal, $kondisi_akhir, $mulai_pinjam, $selesai_pinjam, $lokasi_pinjam, $pic_pinjam, $status;
    public function mount($inventoryId, $logId)
    {
        $this->inventories = Inventory::where('inventoryId', $inventoryId)->first();
        $this->logBook = LogBook::with('inventories')->where('logId', $logId)->first();
        $this->tanggal = $this->logBook->date;
        $this->aksesoris = $this->logBook->aksesoris;
        $this->kondisi_awal = $this->logBook->kondisi_awal;
        $this->kondisi_akhir = $this->logBook->kondisi_akhir;
        $this->mulai_pinjam = $this->logBook->mulai_pinjam;
        $this->selesai_pinjam = $this->logBook->selesai_pinjam;
        $this->lokasi_pinjam = $this->logBook->lokasi_pinjam;
        $this->pic_pinjam = $this->logBook->pic_pinjam;
    }
    public function updateLog()
    {
        LogBook::where('logId', $this->logId)->update([
            'date' => $this->tanggal,
            'aksesoris' => $this->aksesoris,
            'mulai_pinjam' => $this->mulai_pinjam,
            'kondisi_awal' => $this->kondisi_awal,
            'selesai_pinjam' => $this->selesai_pinjam,
            'kondisi_akhir' => $this->kondisi_akhir,
            'lokasi_pinjam' => $this->lokasi_pinjam,
            'pic_pinjam' => $this->pic_pinjam,
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Log Pinjam berhasil diubah!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3000,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('inventories.logs', ['inventoryId' => $this->inventoryId], navigate: true);
    }

    #[Title('Ubah Log Inventaris')]
    public function render(User $user)
    {
        if ($this->authorize('devices', $user)) {
            return view('livewire.inventories.logs.inventory-edit-log', [
                'invEditLog' => $this->inventories,
                'logEdit' => $this->logBook,
            ]);
        } else {
            return view('livewire.dashboard');
        }
    }
}
