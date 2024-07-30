<?php

namespace App\Livewire\Devices;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Device;
use Livewire\Component;
use App\Exports\QrExport;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class DeviceIndex extends Component
{
    use WithPagination;
    public $devices, $device, $deviceId;
    public $adminSearch,
    $search,
    $sortBy = 'created_at',
    $sortDir = 'ASC',
    $perPage = 5,
    $start_date='',
    $end_date='',
    $start_date_admin='',
    $end_date_admin='';
    protected $listeners = ['deleteConfirmed' => 'delete'];
    public function sort($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = $this->sortDir == 'ASC' ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sortByField;
    }

    public function deleteConfirm($deviceId)
    {
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
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('devices.index', navigate: true);
    }
    public function print(Device $device)
    {
        $qr = Device::where('deviceId', $device->deviceId)->first();
        // dd($qr);
        $customSize = [0, 0, 226.77, 170.08];
        $pdf = PDF::loadView('printQR', ['qr' => $qr])->setPaper($customSize);
        // return $pdf->stream('QR_'.Carbon::now().'.pdf')->header('Content-Type','application/pdf');

        return response()->streamDownload(
            function () use ($pdf) {
                echo $pdf->stream();
            },
            'QR_Cal' . $device->deviceId . '.pdf',
            ['Content-Type' => 'application/pdf'],
        );
    }
    public function viewSertif(Device $device)
    {
        $sertif = Device::where('deviceId', $device->deviceId)->first();
        $fileSertif = Storage::url($sertif->certif_file);
        return $fileSertif;
    }

    #[Title('Semua Alat')]
    public function render(User $user)
    {
        if (!$this->authorize('devices', $user)) {
            abort(403);
        } else {
            return view('livewire.devices.device-index', [
                'alatSuperadmin' => Device::search($this->adminSearch)
                    ->when($this->start_date_admin !== '' && $this->end_date_admin !== '', function ($q) {
                        $q->whereDate('created_at', '>=', $this->start_date_admin)
                            ->whereDate('created_at', '<=', $this->end_date_admin);
                    })
                    ->orderByDesc('created_at')
                    ->orderByDesc('updated_at')
                    ->paginate($this->perPage),
                'alats' => Device::search($this->search)
                    ->whereDate('created_at', '>=', $this->start_date)
                    ->whereDate('created_at', '<=', $this->end_date)
                    ->where('user_id', auth()->user()->id)
                    ->orderByDesc('updated_at')
                    ->paginate($this->perPage),
                'qr' => $this->device,
            ]);
        }
    }
}
