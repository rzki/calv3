<?php

namespace App\Livewire\Logbooks;

use App\Models\LogBook;
use Livewire\Component;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

class LogbookCreate extends Component
{
    public $inventories, $no_inv, $mulai_pinjam, $selesai_pinjam, $lokasi_pinjam, $pic, $status;
    public function create()
    {
        LogBook::create([
            'logId' => Str::orderedUuid(),
            'inventory_id' => $this->no_inv,
            'tanggal_mulai_pinjam' => $this->mulai_pinjam,
            'tanggal_selesai_pinjam' => $this->selesai_pinjam,
            'lokasi_pinjam' => $this->lokasi_pinjam,
            'pic' => $this->pic,
            'status' => 'Dipinjamkan'
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Log Pinjam berhasil ditambahkan!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 3000,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('logbooks.index', navigate:true);
    }

    #[Title('Tambah Log Pinjam')]
    public function render()
    {
        $this->inventories = Inventory::with('devnames')->get();
        return view('livewire.logbooks.logbook-create',[
            'inventoryName' => $this->inventories
        ]);
    }
}
