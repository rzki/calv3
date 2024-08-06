<?php

namespace App\Livewire\Hospitals;

use App\Exports\HospitalDeviceExport;
use Carbon\Carbon;
use App\Models\Device;
use Livewire\Component;
use App\Models\Hospital;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class HospitalDetail extends Component
{
    public $detailRS, $hospitalId, $alat, $deviceId;
    public $search,
        $sortBy = 'created_at',
        $sortDir = 'ASC',
        $perPage = 5;
    protected $listeners = ['unlinkConfirmed' => 'unlink'];
    public function mount($hospitalId)
    {
        $this->detailRS = Hospital::where('hospitalId', $hospitalId)->first();
        // $this->alat = ;
    }
    public function deleteConfirm($deviceId)
    {
        $this->deviceId = $deviceId;
        $this->dispatch('delete-confirmation');
    }
    public function unlinkConfirm($deviceId)
    {
        $this->deviceId = $deviceId;
        $this->dispatch('unlink-confirmation');
    }
    public function unlink()
    {
        Device::where('deviceId', $this->deviceId)->update([
            'hospital_id' => null,
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Alat berhasil dihapus dari Data Pelanggan!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('hospitals.detail', ['hospitalId' => $this->hospitalId], navigate: true);
    }
    public function delete()
    {
        Device::where('deviceId', $this->deviceId)->delete();
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Data Pelanggan berhasil dihapus!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('hospitals.detail', ['hospitalId' => $this->hospitalId], navigate: true);
    }

    public function export()
    {
        $tanggal = Carbon::today();
        $namaFile = 'QR-Cal-' . $tanggal->format('j_m_Y');
        return Excel::download(new HospitalDeviceExport(), $namaFile . '.xlsx');
    }
    #[Title('Detail Data Pelanggan')]
    public function render()
    {
        if (Auth::user()->hasRole('Teknisi')) {
            abort(403);
        } else {
            return view('livewire.hospitals.hospital-detail', [
                'detailRS' => $this->detailRS,
                'alatRS' => Device::with('hospitals')
                    ->searchDeviceByHospitalId($this->search)
                    ->where('hospital_id', $this->detailRS->id)
                    ->orderByDesc('updated_at')
                    ->paginate($this->perPage),
            ]);
        }
    }
}
