<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserCreate extends Component
{
    public $nama, $email, $roles;
    public function create()
    {
        User::create([
            'userId'=> Str::orderedUuid(),
            'name' => $this->nama,
            'username' => str_replace(' ', '_', $this->nama),
            'email' => $this->email,
            'role_id' => $this->roles,
            'password' => Hash::make('Calibration24!')
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User berhasil ditambahkan!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('users.index', navigate:true);
    }
    public function render()
    {
        return view('livewire.users.user-create',[
            'role' => Role::where('id', '!=', 1)->get()
        ]);
    }
}
