<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Device;
use Milon\Barcode\DNS2D;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateQRJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $devices;

    /**
     * Create a new job instance.
     */
    public function __construct($devices)
    {
        $this->devices = $devices;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $devices = [];
        foreach ($this->devices as $device){
            // Generate QR code and path
            $qr = new DNS2D();
            $qr = base64_decode($qr->getBarcodePNG(route('devices.detail', $device['deviceId']), "QRCODE"));
            $path = 'img/qr-codes/' . $device['deviceId'] . '.png';
            Storage::disk('public')->put($path, $qr);

            $devices[] = [
                'deviceId' => $device['deviceId'],
                'inv_number' => 'INVT-',
                'barcode' => $path,
                'user_id' => auth()->user()->id,
                'status' => 'Tersedia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        DB::table('devices')->insert($devices);
    }
}
