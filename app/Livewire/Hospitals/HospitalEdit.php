<?php

namespace App\Livewire\Hospitals;

use Livewire\Component;
use App\Models\Hospital;
use Livewire\Attributes\Title;

class HospitalEdit extends Component
{
    public $hospitals, $hospitalId, $name, $phone_number, $address;
    public function mount($hospitalId)
    {
        $this->hospitals = Hospital::where('hospitalId', $hospitalId)->first();
        $this->name = $this->hospitals->name;
        $this->phone_number = $this->hospitals->phone_number;
        $this->address = $this->hospitals->address;
    }
    public function update()
    {
        Hospital::where('hospitalId', $this->hospitalId)->update([
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Rumah Sakit berhasil diperbarui!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3000,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('hospitals.index', navigate: true);
    }
    #[Title('Update Rumah Sakit')]
    public function render()
    {
        if ($this->authorize('viewHospitals')) {
            return view('livewire.hospitals.hospital-edit', [
                'hospitals' => $this->hospitals,
            ]);
        } else {
            return view('livewire.dashboard');
        }
    }
}
