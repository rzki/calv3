<?php

namespace App\Livewire\Users\RumahSakit;

use App\Models\User;
use Livewire\Component;
use App\Models\Hospital;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;

class UserRumahSakitEdit extends Component
{
    public $users, $userRsId, $nama, $username, $email, $rs, $roles;
    public function mount($userRsId)
    {
        $this->users = User::with(['roles', 'hospitals'])->where('userId', $userRsId)->first();
        $this->nama = $this->users->name;
        $this->username = $this->users->username;
        $this->email = $this->users->email;
    }
    public function update()
    {
        User::where('userId', $this->userRsId)->update([
            'name' => $this->nama,
            'username' => $this->username,
            'email' => $this->email,
            'user_hospital_id' => $this->rs
        ]);
        $this->users->assignRole('User');
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User berhasil diperbarui!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('user-rs.index', navigate: true);
    }
    #[Title('Update User')]
    public function render()
    {
        return view('livewire.users.rumah-sakit.user-rumah-sakit-edit',[
                'hospital' => Hospital::all()
        ]);
    }
}
