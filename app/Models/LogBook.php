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
    public function scopeSearch($query, $value)
    {
        $query->whereHas('inventories', function ($query) use ($value) {
            $query->whereHas('devnames', function ($query) use ($value) {
                $query->where('device_name', 'like', "%{$value}%")
                    ->orWhereNull('device_name', 'like', "%{$value}%")
                    ->orWhere('brand', 'like', "%{$value}%")
                    ->orWhereNull('brand', 'like', "%{$value}%")
                    ->orWhere('type', 'like', "%{$value}%")
                    ->orWhereNull('type', 'like', "%{$value}%")
                    ->orWhere('sn', 'like', "%{$value}%")
                    ->orWhereNull('sn', 'like', "%{$value}%");
            });
        });
    }
    public function scopeSearchLogByInventoryId($query, $value)
    {
        $query->whereHas('inventories', function ($query) use ($value) {
            $query->where('pic_pinjam', 'like', "%{$value}%")
                ->orWhere('lokasi_pinjam', 'like', "%{$value}%");
        });
    }

}
