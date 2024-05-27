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
            $query->where('serial_number', 'like', "%{$value}%")
                ->orWhereNull('serial_number', 'like', "%{$value}%");
        })
        ;
    }
}
