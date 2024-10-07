<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Permission;
use Livewire\Attributes\Title;

class RoleEdit extends Component
{
    public $roles, $roleId, $permissions, $name, $permission_list;
    public $perPage = 5;
    public function mount($roleId)
    {
        $this->roles = Role::where('id', $roleId)->first();
        $this->name = $this->roles->name;
    }
    public function update()
    {
        Role::where('id', $this->roleId)->update([
            'name' => $this->name,
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Role berhasil diubah!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('roles.index', navigate: true);
    }
    #[Title('Update Role')]
    public function render(User $user)
    {
        if ($this->authorize('adminAccess', $user)) {
            return view('livewire.roles.role-edit', [
                'allPermissions' => Permission::all(),
            ]);
        } else {
            return view('livewire.dashboard');
        }
    }
}
