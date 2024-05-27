<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function getRouteKeyName()
    {
        return 'inventoryId';
    }
    public function logbooks()
    {
        return $this->hasMany(LogBook::class);
    }
    public function devnames()
    {
        return $this->belongsTo(DeviceName::class, 'device_name');
    }

    public function scopeSearch($query, $value)
    {
        $query->whereHas('devnames', function ($query) use ($value) {
            $query->where('device_name', 'like', "%{$value}%")
                ->orWhereNull('device_name', 'like', "%{$value}%");

        })
        ->orWhere('brand', 'like', "%{$value}%")
        ->orWhere('type', 'like', "%{$value}%")
        ->orWhere('sn', 'like', "%{$value}%")
        ;
    }
}
