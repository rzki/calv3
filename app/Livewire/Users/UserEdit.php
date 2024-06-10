<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;

class UserEdit extends Component
{
    public $users, $userId, $nama, $username, $email, $roles;
    public function mount($userId)
    {
        $this->users = User::with('roles')->where('userId', $userId)->first();
        $this->nama = $this->users->name;
        $this->username = $this->users->username;
        $this->email = $this->users->email;
        $this->roles = $this->users->role_id;
    }
    public function update()
    {
        User::where('userId', $this->userId)->update([
            'name' => $this->nama,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make('Calibration24!'),
        ]);
        $this->users->assignRole($this->roles);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User berhasil diperbarui!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('users.index', navigate: true);
    }
    #[Title('Update User')]
    public function render(User $user)
    {
        if ($this->authorize('adminAccess', $user)) {
            return view('livewire.users.user-edit', [
                'role' => Role::where('id', '!=', 1)->get(),
            ]);
        } else {
            return view('livewire.dashboard');
        }
    }
}
