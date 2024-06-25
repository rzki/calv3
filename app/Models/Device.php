<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Device extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'devices';
    public function getRouteKeyName()
    {
        return 'deviceId';
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function names()
    {
        return $this->belongsTo(DeviceName::class, 'name_id');
    }
    public function hospitals()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
    public function scopeSearch($query, $value)
    {
        $query->whereHas('users', function ($query) use ($value) {
            $query->where('serial_number', 'like', "%{$value}%")->orWhereNull('serial_number', 'like', "%{$value}%");
        });
    }

    public function scopeInventorySearch($query, $value)
    {
        $query->whereHas('devnames', function ($query) use ($value) {
            $query->where('device_name', 'like', "%{$value}%")
                ->orWhereNull('device_name', 'like', "%{$value}%");

        })
        ->orWhere('brand', 'like', "%{$value}%")
        ->orWhere('type', 'like', "%{$value}%")
        ->orWhere('serial_number', 'like', "%{$value}%")
        ;
    }
    public function scopeSearchDeviceByHospitalId($query, $value)
    {
        $query->whereHas('hospitals', function ($query) use ($value){
            $query->where('name_id', 'like', "%{$value}%")
                    ->orWhere('serial_number', 'like', "%{$value}%")
                    ->orWhereNull('name_id', 'like', "%{$value}%")
                    ->orWhereNull('serial_number', 'like', "%{$value}%");
        });
    }
}
