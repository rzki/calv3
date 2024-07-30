<?php

namespace App\Exports;

use App\Models\Device;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class HospitalDeviceExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exportTable', [
            'alats' => Device::with('devNames')->get()
        ]);
    }
}
