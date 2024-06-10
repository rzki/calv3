<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    public $user, $userId;
    public $search,
        $perPage = 5;
    public $listeners = ['deleteConfirmed' => 'delete'];
    public function deleteConfirm($userId)
    {
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
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('users.index', navigate: true);
    }
    #[Title('Semua User')]
    public function render(User $user)
    {
        if ($this->authorize('viewUsers', $user)) {
            return view('livewire.users.user-index', [
                'users' => User::search($this->search)
                    ->with('roles')
                    ->where('name', '!=', 'Superadmin')
                    ->paginate($this->perPage),
            ]);
        }else{
            return view('livewire.dashboard');
        }
    }
}
