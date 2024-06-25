<?php

namespace App\Livewire\Inventories;

use App\Models\Device;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Inventory;
use App\Models\DeviceName;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

class InventoryCreate extends Component
{
    public $nama, $merk, $tipe, $sn, $tahun, $no_inv, $kalibrasi_terakhir, $pic, $lokasi, $status;
    public function create()
    {
        Device::create([
            'deviceId' => Str::orderedUuid(),
            'name_id' => $this->nama,
            'brand' => $this->merk,
            'type' => $this->tipe,
            'serial_number' => $this->sn,
            'procurement_year' => $this->tahun,
            'inv_number' => $this->no_inv,
            'last_calibrated_date' => $this->kalibrasi_terakhir,
            'next_calibrated_date' => Carbon::parse($this->kalibrasi_terakhir)->addYear(),
            'pic' => $this->pic,
            'location' => $this->lokasi,
            'status' => 'Tersedia'
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Inventaris berhasil ditambahkan!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 3000,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('inventories.index', navigate:true);

    }
    #[Title('Tambah Inventaris')]
    public function render(User $user)
    {
        if ($this->authorize('adminAccess', $user)) {
                    return view('livewire.inventories.inventory-create', [
                        'namaAlat' => DeviceName::all()
                    ]);
        } else {
            return view('livewire.dashboard');
        }

    }
}
