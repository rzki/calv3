<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;

class UserCreate extends Component
{
    public $nama, $email, $roles;
    public function create()
    {
        $user = User::create([
            'userId' => Str::orderedUuid(),
            'name' => $this->nama,
            'username' => str_replace(' ', '_', $this->nama),
            'email' => $this->email,
            'password' => Hash::make('Calibration24!'),
        ]);
        $user->assignRole($this->roles);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User berhasil ditambahkan!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('users.index', navigate: true);
    }
    #[Title('Tambah User')]
    public function render()
    {
        if ($this->authorize('accessUsers')) {
            return view('livewire.users.user-create', [
                'role' => Role::where('id', '!=', 1)->get(),
            ]);
        } else {
            return view('livewire.dashboard');
        }
    }
}
