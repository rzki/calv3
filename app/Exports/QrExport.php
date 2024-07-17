<?php

namespace App\Exports;

use App\Models\Device;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class QrExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exportTable', [
            'alats' => Device::with('names')->get()
        ]);
    }
}
