<?php

namespace App\Livewire\Devices;

use Carbon\Carbon;
use App\Models\Device;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeviceIndex extends Component
{
    use WithPagination;
    public $devices, $device, $deviceId;
    public $search, $sortBy='created_at', $sortDir='ASC', $perPage=5;
    protected $listeners = ['deleteConfirmed' => 'delete'];
    public function sort($sortByField)
    {
        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sortByField;
    }

    public function deleteConfirm($deviceId){
        $this->deviceId = $deviceId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $this->devices = Device::where('deviceId', $this->deviceId)->first();
        $this->devices->delete();
        Storage::disk('public')->delete($this->devices->barcode);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Alat berhasil dihapus!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('devices.index', navigate:true);
    }
    public function print(Device $device)
    {
        $qr = Device::where('deviceId', $device->deviceId)->first();
        // dd($qr);
        $customSize = [0, 0, 226.77, 170.08];
        $pdf = PDF::loadView('printQR', ['qr' => $qr])->setPaper($customSize);
        // return $pdf->stream('QR_'.Carbon::now().'.pdf')->header('Content-Type','application/pdf');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'QR_Cal'.$device->deviceId.'.pdf', ['Content-Type'=>'application/pdf']);
    }
    #[Title('Semua Alat')]
    public function render()
    {
        return view('livewire.devices.device-index', [
            'alatSuperadmin' => Device::search($this->search)
            ->paginate($this->perPage),
            'alats' => Device::search($this->search)
            ->where('user_id', auth()->user()->id)
            ->paginate($this->perPage),
            'qr' => $this->device
        ]);
    }
}
