<?php

namespace App\Exports;

use App\Models\Device;
use App\Models\Hospital;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

// class HospitalDeviceExport implements FromView
class HospitalDeviceExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function view(): View
    // {
    //     return view('exportTableHospital', [
    //         'cust' => Hospital::with('devices')->get()
    //     ]);
    // }

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Nomor Telepon',
            'Alamat'
        ];
    }
    public function query()
    {
        return $this->query;
    }
}
