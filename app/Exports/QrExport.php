<?php

namespace App\Exports;

use App\Models\Device;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

// class QrExport implements FromView
class QrExport implements FromQuery, WithHeadings, WithMapping
// class QrExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;
    // protected $search, $start_date_admin, $end_date_admin, $perPage;
    protected $query;
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function view(): View
    // {
    //     return view('exportTable', [
    //         'alats' => Device::with('names')->get()
    //     ]);
    // }
    public function __construct($query)
    // public function __construct($search, $start_date_admin, $end_date_admin, $perPage)
    {
        $this->query = $query;
        // $this->search = $search;
        // $this->start_date_admin = $start_date_admin;
        // $this->end_date_admin = $end_date_admin;
        // $this->perPage = $perPage;
    }

    public function query()
    {
        return $this->query;
    }
    // public function collection()
    // {
    //     // Superadmin, Admin and Manager query
    //     if(Auth::user()->hasRole(['Superadmin', 'Admin', 'Manager'])){
    //         Device::with(['devNames', 'users'])->search($this->search)
    //                 ->when($this->start_date_admin !== '' && $this->end_date_admin !== '', function ($q) {
    //                     $q->whereDate('created_at', '>=', $this->start_date_admin)
    //                         ->whereDate('created_at', '<=', $this->end_date_admin);
    //                 })
    //                 ->orderByDesc('updated_at')
    //                 ->take($this->perPage)
    //                 ->get();
    //     }// Teknisi query
    //     else{
            // Device::with(['devNames', 'users'])->search($this->search)
            //             ->when($this->start_date_admin !== '' && $this->end_date_admin !== '', function ($q) {
            //                 $q->whereDate('created_at', '>=', $this->start_date_admin)
            //                     ->whereDate('created_at', '<=', $this->end_date_admin);
            //             })
            //             ->where('user_id', Auth::user()->id)
            //             ->orWhereNull('user_id')
            //             ->orderByDesc('updated_at')
            //             ->paginate($this->perPage);
    //     }
    // }
    public function map($device): array
    {
        return [
                $device->devNames->name ?? '',
                $device->brand ?? '',
                $device->type ?? '',
                $device->serial_number ?? '',
                $device->location ?? '',
                date('d/m/Y', strtotime($device->calibration_date)) ?? '',
                'CAL-'.$device->serial_number ?? '',
                $device->result ?? '',
                $device->status ?? '',
                $device->users->name ?? ''
            ];
    }

    public function headings(): array
    {
        return [
            'Nama Alat',
            'Merk',
            'Tipe',
            'No. Seri',
            'Ruang',
            'Tanggal Kalibrasi',
            'No. Sertifikat',
            'Hasil',
            'Status',
            'Petugas Kalibrasi'
        ];
    }
}
