<?php

namespace App\Livewire\Logbooks;

use App\Models\LogBook;
use Livewire\Component;
use App\Models\DeviceName;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

class LogbookCreate extends Component
{
    public $device_name_id, $merk, $tipe, $serial_number, $mulai, $selesai, $lokasi, $pic, $status;
    public function create()
    {
        LogBook::create([
            'logId' => Str::orderedUuid(),
            'device_name_id' => $this->device_name_id,
            'submitter_id' => Auth::user()->id,
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
    #[Title('Tambah Logbook Item')]
    public function render()
    {
        return view('livewire.logbooks.logbook-create', [
            'deviceName' => DeviceName::all()
        ]);
    }
}
