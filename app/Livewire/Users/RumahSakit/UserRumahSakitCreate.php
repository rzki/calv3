<?php

namespace App\Livewire\Users\RumahSakit;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;

class UserRumahSakitCreate extends Component
{
    public $nama, $email, $roles, $rs;
    public function create()
    {
        $user = User::create([
            'userId' => Str::orderedUuid(),
            'name' => $this->nama,
            'username' => str_replace(' ', '_', $this->nama),
            'email' => $this->email,
            'password' => Hash::make('Calibration24!'),
            'user_hospital_id' => $this->rs
        ]);
        $user->assignRole('User');
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User Rumah Sakit berhasil ditambahkan!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('user-rs.index', navigate: true);
    }
    #[Title('Tambah User')]
    public function render(User $user)
    {
        if($this->authorize('adminAccess', $user)){
            return view('livewire.users.rumah-sakit.user-rumah-sakit-create');
        }else{
            abort(403);
        }
    }
}
