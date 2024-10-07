<?php

namespace App\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Hospital;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;

class UserEdit extends Component
{
    public $users, $userId, $nama, $username, $email, $rs, $roles;
    public function mount($userId)
    {
        $this->users = User::with(['roles', 'hospitals'])->where('userId', $userId)->first();
        $this->nama = $this->users->name;
        $this->username = $this->users->username;
        $this->email = $this->users->email;
    }
    public function update()
    {
        User::where('userId', $this->userId)->update([
            'name' => $this->nama,
            'username' => $this->username,
            'email' => $this->email,
        ]);
        $this->users->assignRole($this->roles);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User berhasil diubah!',
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
                'hospital' => Hospital::all()
            ]);
        } else {
            return view('livewire.dashboard');
        }
    }
}
