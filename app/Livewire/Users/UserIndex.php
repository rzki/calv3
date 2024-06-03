<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;

class UserIndex extends Component
{
    public $user, $userId;
    public $search, $perPage = 5;
    public $listeners = ['deleteConfirmed' => 'delete'];
    public function deleteConfirm($userId){
        $this->userId = $userId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $this->user = User::where('userId', $this->userId)->first();
        $this->user->delete();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User berhasil dihapus!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('users.index', navigate:true);
    }
    #[Title('Semua User')]
    public function render()
    {
        return view('livewire.users.user-index', [
            'users' => User::with('roles')
            ->search($this->search)
            ->where('role_id', '!=', 1)
            ->paginate($this->perPage)
        ]);
    }
}
