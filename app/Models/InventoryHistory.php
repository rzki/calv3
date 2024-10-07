<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryHistory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'inventory_histories';
    public function inventories()
    {
        return $this->belongsTo(Inventory::class);
    }
}
