<?php

namespace App\Livewire\Logbooks;

use App\Models\LogBook;
use Livewire\Component;
use App\Models\DeviceName;

class LogbookEdit extends Component
{
    public $logbooks, $logId, $device_name_id, $merk, $tipe, $serial_number, $mulai, $selesai, $lokasi, $pic, $status;
    public function mount($logId)
    {
        $this->logbooks = LogBook::where('logId', $logId)->first();
        $this->device_name_id = $this->logbooks->device_name_id;
        $this->merk = $this->logbooks->brand;
        $this->tipe = $this->logbooks->type;
        $this->serial_number = $this->logbooks->serial_number;
        $this->mulai = $this->logbooks->mulai_pinjam;
        $this->selesai = $this->logbooks->selesai_pinjam;
        $this->lokasi = $this->logbooks->lokasi_pinjam;
        $this->pic = $this->logbooks->pic_pinjam;
        $this->status = $this->logbooks->status;
    }
    public function update()
    {
        LogBook::where('logId', $this->logId)->update([
            'device_name_id' => $this->device_name_id,
            'brand' => $this->merk,
            'type' => $this->tipe,
            'serial_number' => $this->serial_number,
            'mulai_pinjam' => $this->mulai,
            'selesai_pinjam' => $this->selesai,
            'lokasi_pinjam' => $this->lokasi,
            'pic_pinjam' => $this->pic,
            'status' => $this->status
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Log baru berhasil ditambahkan!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 3000,
            'showConfirmButton'=> false
        ]);

        return $this->redirectRoute('logbooks.index', navigate:true);
    }
    public function render()
    {
        return view('livewire.logbooks.logbook-edit', [
            'deviceName' => DeviceName::all()
        ]);
    }
}
