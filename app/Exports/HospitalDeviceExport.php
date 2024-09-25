<?php

namespace App\Exports;

use App\Models\Device;
use App\Models\Hospital;
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
        return view('exportTableHospital', [
            'cust' => Hospital::with('devices')->get()
        ]);
    }
}
