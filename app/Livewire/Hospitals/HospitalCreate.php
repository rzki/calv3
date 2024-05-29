<?php

namespace App\Livewire\Hospitals;

use Livewire\Component;
use App\Models\Hospital;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

class HospitalCreate extends Component
{
    public $name, $phone_number, $address;
    public function create()
    {
        Hospital::create([
            'hospitalId' => Str::orderedUuid(),
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'address' => $this->address
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Rumah Sakit berhasil ditambahkan!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 3000,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('hospitals.index', navigate:true);
    }
    #[Title('Tambah Rumah Sakit')]
    public function render()
    {
        return view('livewire.hospitals.hospital-create');
    }
}
