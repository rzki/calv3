<?php

namespace App\Livewire\Logbooks;

use App\Models\User;
use App\Models\LogBook;
use Livewire\Component;
use App\Models\Inventory;
use App\Models\DeviceName;
use Livewire\Attributes\Title;

class LogbookEdit extends Component
{
    public $logbooks, $logId, $inventory_id, $tanggal, $aksesoris, $kondisi_awal, $kondisi_akhir, $mulai_pinjam, $selesai_pinjam, $lokasi_pinjam, $pic_pinjam, $status;
    public function mount($logId)
    {
        $this->logbooks = LogBook::where('logId', $logId)->first();
        $this->inventory_id = $this->logbooks->inventory_id;
        $this->tanggal = $this->logbooks->date;
        $this->aksesoris = $this->logbooks->aksesoris;
        $this->kondisi_awal = $this->logbooks->kondisi_awal;
        $this->kondisi_akhir = $this->logbooks->kondisi_akhir;
        $this->mulai_pinjam = $this->logbooks->mulai_pinjam;
        $this->selesai_pinjam = $this->logbooks->selesai_pinjam;
        $this->lokasi_pinjam = $this->logbooks->lokasi_pinjam;
        $this->pic_pinjam = $this->logbooks->pic_pinjam;
        $this->status = $this->logbooks->status;
    }
    public function update()
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
            'title' => 'Log baru berhasil diubah!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 3000,
            'showConfirmButton'=> false
        ]);

        return $this->redirectRoute('logbooks.index', navigate:true);
    }
    #[Title('Ubah Entri Logbook')]
    public function render(User $user)
    {
        if($this->authorize('editLogbooks', $user)){
            return view('livewire.logbooks.logbook-edit', [
                'inventory' => Inventory::all()
            ]);
        }else{
            abort(403);
        }
    }
}
