<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Role;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function getRouteKeyName()
    {
        return 'userId';
    }
    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%")
        ->orWhere('email', 'like', "%{$value}%")
        ->orWhereHas('roles', function($query) use ($value){
            $query->where('role_name', 'like', "%{$value}%");
        });
    }
}
