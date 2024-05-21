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
    public function inventories()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
}
