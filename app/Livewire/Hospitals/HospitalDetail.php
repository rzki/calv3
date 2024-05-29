<?php

namespace App\Livewire\Hospitals;

use Livewire\Component;
use App\Models\Hospital;
use Livewire\Attributes\Title;

class HospitalDetail extends Component
{
    public $detailRS, $hospitalId;
    public function mount($hospitalId)
    {
        $this->detailRS = Hospital::where('hospitalId', $hospitalId)->first();
    }
    #[Title('Detail Rumah Sakit')]
    public function render()
    {
        return view('livewire.hospitals.hospital-detail',[
            'detailRS' => $this->detailRS
        ]);
    }
}
