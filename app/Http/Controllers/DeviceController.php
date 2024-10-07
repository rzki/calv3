<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class DeviceController extends Controller
{
    public function printAll()
    {
        $devices = DB::table('devices')
                    ->whereNull('name_id')
                    ->orWhereNull('serial_number')
                    ->where('user_id', Auth::user()->id)
                    ->pluck('barcode');
        $customSize = array(0,0,226.77,170.08);
        $pdf = Pdf::loadView('printAllQR', ['devices' => $devices])->setPaper($customSize);
        return $pdf->stream('QR_Cal_'.Carbon::now()->format('d/m/Y').'_'.uniqid().'.pdf')->header('Content-Type','application/pdf');
        // return response()->streamDownload(function () use ($pdf) {
        //     echo $pdf->stream();
        // }, 'QR_Cal_'.Carbon::now()->format('d/m/Y').'_'.uniqid().'.pdf', ['Content-Type'=>'application/pdf']);
    }
}
