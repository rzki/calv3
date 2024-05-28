<?php

namespace App\Livewire\Logbooks;

use App\Models\LogBook;
use Livewire\Component;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

class LogbookEdit extends Component
{
    public $logs, $logId, $invId, $no_inv, $mulai_pinjam, $selesai_pinjam, $lokasi_pinjam, $pic, $status;
    public function mount($logId)
    {
        $this->logs = LogBook::where('logId', $logId)->first();
        $this->invId = Inventory::with('devnames')->get();
        $this->no_inv = $this->logs->inventory_id;
        $this->mulai_pinjam = $this->logs->tanggal_mulai_pinjam;
        $this->selesai_pinjam = $this->logs->tanggal_selesai_pinjam;
        $this->lokasi_pinjam = $this->logs->lokasi_pinjam;
        $this->pic = $this->logs->pic;
        $this->status = $this->logs->status;
    }
    public function update()
    {
        LogBook::where('logId', $this->logId)->update([
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
            'title' => 'Log Pinjam berhasil diperbarui!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 3000,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('logbooks.index', navigate:true);
    }
    #[Title('Edit Log Pinjam')]
    public function render()
    {
        return view('livewire.logbooks.logbook-edit', [
            'logbooks' => $this->logs,
            'invId' => $this->invId
        ]);
    }
}
