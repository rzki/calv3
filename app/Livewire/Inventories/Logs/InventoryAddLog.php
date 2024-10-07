<?php

namespace App\Livewire\Inventories\Logs;

use App\Models\Device;
use Carbon\Carbon;
use App\Models\User;
use App\Models\LogBook;
use Livewire\Component;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

class InventoryAddLog extends Component
{
    public $inventories, $inventoryId, $tanggal, $aksesoris, $kondisi_awal, $kondisi_akhir, $mulai_pinjam, $selesai_pinjam, $lokasi_pinjam, $pic_pinjam, $status;
    public function mount($inventoryId)
    {
        $this->inventories = Inventory::where('inventoryId', $inventoryId)->first();
    }
    public function addLog()
    {
        LogBook::create([
            'logId' => Str::orderedUuid(),
            'date' => $this->tanggal,
            'inventory_id' => $this->inventories->id,
            'aksesoris' => $this->aksesoris,
            'mulai_pinjam' => $this->mulai_pinjam,
            'kondisi_awal' => $this->kondisi_awal,
            'selesai_pinjam' => $this->selesai_pinjam,
            'kondisi_akhir' => $this->kondisi_akhir,
            'lokasi_pinjam' => $this->lokasi_pinjam,
            'pic_pinjam' => $this->pic_pinjam,
            'status' => 'Dipinjamkan',
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Log Inventaris berhasil ditambahkan!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3000,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('inventories.logs', ['inventoryId' => $this->inventoryId], navigate: true);
    }

    #[Title('Tambah Log Inventaris')]
    public function render(User $user)
    {
        if ($this->authorize('devices', $user)) {
            return view('livewire.inventories.logs.inventory-add-log', [
                'invAddLog' => $this->inventories,
            ]);
        } else {
            return view('livewire.dashboard');
        }
    }
}
