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
        return $this->belongsTo(Inventory::class);
    }
    public function scopeSearch($query, $value)
    {
        // $query->whereHas('devices', function ($query) use ($value) {
        // $query->whereHas('deviceNames', function ($query) use ($value) {
        $query
            ->where('aksesoris', 'like', "%{$value}%")
            ->orWhere('kondisi_awal', 'like', "%{$value}%")
            ->orWhere('pic_pinjam', 'like', "%{$value}%");
        // });
        // $query->orWhere('inv_number', 'like', "%{$value}%");
        // });
    }
    public function scopeSearchLogByInventoryId($query, $value)
    {
        $query->where('pic_pinjam', 'like', "%{$value}%")->orWhere('lokasi_pinjam', 'like', "%{$value}%");
    }
}
