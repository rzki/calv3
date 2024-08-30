<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

class RoleIndex extends Component
{
    use WithPagination;
    public $roles, $roleId;
    public $search,
        $perPage = 5;
    public $listeners = ['deleteConfirmed' => 'delete'];
    public function deleteConfirm($roleId)
    {
        $this->roleId = $roleId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $this->roles = Role::where('id', $this->roleId)->first();
        $this->roles->delete();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Role berhasil dihapus!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('roles.index', navigate: true);
    }
    #[Title('Semua Role')]
    public function render(User $user)
    {
        if ($this->authorize('adminAccess', $user)) {
            return view('livewire.roles.role-index', [
                'role' => Role::search($this->search)
                    ->where('name', '!=', 'Superadmin')
                    ->paginate($this->perPage),
            ]);
        } else {
            return view('livewire.dashboard');
        }
    }
}
