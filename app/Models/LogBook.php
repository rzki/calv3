<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBook extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'logbooks';
    public function getRouteKeyName()
    {
        return 'logId';
    }
    public function devices()
    {
        return $this->belongsTo(Device::class);
    }
    public function deviceNames()
    {
        return $this->belongsTo(DeviceName::class, 'device_name_id');
    }
    public function scopeSearch($query, $value)
    {
        // $query->whereHas('devices', function ($query) use ($value) {
            $query->whereHas('deviceNames', function ($query) use ($value) {
                $query->where('device_name_id', 'like', "%{$value}%")
                    ->orWhereNull('device_name_id', 'like', "%{$value}%")
                    ->orWhere('brand', 'like', "%{$value}%")
                    ->orWhereNull('brand', 'like', "%{$value}%")
                    ->orWhere('type', 'like', "%{$value}%")
                    ->orWhereNull('type', 'like', "%{$value}%")
                    ->orWhere('serial_number', 'like', "%{$value}%")
                    ->orWhereNull('serial_number', 'like', "%{$value}%");
            });
            // $query->orWhere('inv_number', 'like', "%{$value}%");
        // });
    }
    public function scopeSearchLogByInventoryId($query, $value)
    {
        $query->whereHas('inventories', function ($query) use ($value) {
            $query->where('pic_pinjam', 'like', "%{$value}%")
                ->orWhere('lokasi_pinjam', 'like', "%{$value}%");
        });
    }

}
