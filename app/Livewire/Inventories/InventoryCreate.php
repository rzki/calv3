<?php

namespace App\Livewire\Inventories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Device;
use Livewire\Component;
use Milon\Barcode\DNS2D;
use App\Models\Inventory;
use App\Models\DeviceName;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;

class InventoryCreate extends Component
{
    public $nama, $merk, $tipe, $sn, $tahun, $no_inv, $kalibrasi_terakhir, $pic, $lokasi, $status;
    public function create()
    {
        $uuid = Str::orderedUuid();
        $qr = new DNS2D();
        $qr = base64_decode($qr->getBarcodePNG(route('inventories.publicDetail', $uuid), "QRCODE"));
        $path = 'img/inventory/qr/' . $uuid . '.png';
        Storage::disk('public')->put($path, $qr);
        Inventory::create([
            'inventoryId' => $uuid,
            'device_name' => $this->nama,
            'brand' => $this->merk,
            'type' => $this->tipe,
            'sn' => $this->sn,
            'procurement_year' => $this->tahun,
            'inv_number' => $this->no_inv,
            'last_calibrated_date' => $this->kalibrasi_terakhir,
            'next_calibrated_date' => Carbon::parse($this->kalibrasi_terakhir)->addYear(),
            'location' => $this->lokasi,
            'barcode' => $path,
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
        if ($this->authorize('inventories', $user)) {
                    return view('livewire.inventories.inventory-create', [
                        'namaAlat' => DeviceName::all()
                    ]);
        } else {
            return view('livewire.dashboard');
        }

    }
}
