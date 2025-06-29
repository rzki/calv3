<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function getRouteKeyName()
    {
        return 'hospitalId';
    }
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%")
        ->orWhere('address', 'like', "%{$value}%");
    }
}
