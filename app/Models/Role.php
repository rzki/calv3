<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function getRouteKeyName()
    {
        return 'roleId';
    }
    public function users()
    {
        return $this->hasOne(User::class);
    }
    public function scopeSearch($query, $value)
    {
        $query->where('role_name', 'like', "%{$value}%")
        ->orWhere('code', 'like', "%{$value}%");
    }
}
