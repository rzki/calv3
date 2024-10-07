<?php

namespace App\Livewire\Logbooks;

use App\Models\User;
use App\Models\LogBook;
use Livewire\Component;
use App\Models\Inventory;
use App\Models\DeviceName;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

class LogbookCreate extends Component
{
    public $inventories, $inventoryId, $inventory_id, $tanggal, $aksesoris, $kondisi_awal, $kondisi_akhir, $mulai_pinjam, $selesai_pinjam, $lokasi_pinjam, $pic_pinjam, $status;
    public function create()
    {
        LogBook::create([
            'logId' => Str::orderedUuid(),
            'inventory_id' => $this->inventory_id,
            'date' => $this->tanggal,
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
            'title' => 'Entri Logbook baru berhasil ditambahkan!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 3000,
            'showConfirmButton'=> false
        ]);

        return $this->redirectRoute('logbooks.index', navigate:true);
    }
    #[Title('Tambah Entri Logbook')]
    public function render(User $user)
    {
        if($this->authorize('createLogbooks', $user)){
            return view('livewire.logbooks.logbook-create', [
                'inventory' => Inventory::all()
            ]);

        }else{
            abort(403);
        }
    }
}
