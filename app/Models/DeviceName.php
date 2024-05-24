<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceName extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%");
    }
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
