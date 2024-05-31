<?php

namespace App\Livewire\Hospitals;

use App\Models\Device;
use Livewire\Component;
use App\Models\Hospital;
use Livewire\Attributes\Title;

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
        $this->alat = Device::with('hospitals')
            ->where('hospital_id', $this->detailRS->id)
            ->get();
    }
    public function deleteConfirm($deviceId)
    {
        $this->deviceId = $deviceId;
        $this->dispatch('delete-confirmation');
    }
    public function unlinkConfirm($deviceId)
    {
        $this->deviceId = $deviceId;
        $this->dispatch('unlink-confirmationconfirmation');
    }
    public function unlink()
    {
        Device::where('deviceId', $this->deviceId)->update([
            'hospital_id' => null,
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Alat berhasil dihapus dari rumah sakit!',
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
            'title' => 'Rumah Sakit berhasil dihapus!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('hospitals.detail', ['hospitalId' => $this->hospitalId], navigate: true);
    }
    #[Title('Detail Rumah Sakit')]
    public function render()
    {
        return view('livewire.hospitals.hospital-detail', [
            'detailRS' => $this->detailRS,
            'alat' => $this->alat,
        ]);
    }
}
