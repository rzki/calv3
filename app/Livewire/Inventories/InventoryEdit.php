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

class InventoryEdit extends Component
{
    public $inventories,
        $inventoryId,
        $invName,
        $nama,
        $merk,
        $tipe,
        $sn,
        $tahun,
        $no_inv,
        $kalibrasi_terakhir,
        $pic,
        $lokasi,
        $status;
    public function mount($inventoryId)
    {
        $this->inventories = Inventory::where('inventoryId', $inventoryId)->first();
        $this->nama = $this->inventories->device_name;
        $this->merk = $this->inventories->brand;
        $this->tipe = $this->inventories->type;
        $this->sn = $this->inventories->sn;
        $this->tahun = $this->inventories->procurement_year;
        $this->no_inv = $this->inventories->inv_number;
        $this->kalibrasi_terakhir = $this->inventories->last_calibrated_date;
        $this->pic = $this->inventories->pic;
        $this->lokasi = $this->inventories->location;
        $this->status = $this->inventories->status;
    }
    public function update()
    {
        Inventory::where('inventoryId', $this->inventoryId)->update([
            'device_name' => $this->nama,
            'brand' => $this->merk,
            'type' => $this->tipe,
            'sn' => $this->sn,
            'procurement_year' => $this->tahun,
            'inv_number' => $this->no_inv,
            'last_calibrated_date' => $this->kalibrasi_terakhir,
            'next_calibrated_date' => Carbon::parse($this->kalibrasi_terakhir)->addYear(),
            'pic' => $this->pic,
            'location' => $this->lokasi,
            // 'status' => $this->status,
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Inventaris berhasil diubah!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3000,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('inventories.index', navigate: true);
    }
    #[Title('Update Inventaris')]
    public function render(User $user)
    {
        if ($this->authorize('inventories', $user)) {
            return view('livewire.inventories.inventory-edit', [
                'invEdit' => $this->inventories,
                'namaAlat' => $this->invName,
            ]);
        } else {
            return view('livewire.dashboard');
        }
    }
}
