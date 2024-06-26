<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory;
    protected $guarded = ['id'];
    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%");
    }
}
