<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use Livewire\Component;
use Livewire\Attributes\Title;

class RoleEdit extends Component
{
    public $roles, $roleId, $name, $code;
    public function mount($roleId)
    {
        $this->roles = Role::where('roleId', $roleId)->first();
        $this->name = $this->roles->role_name;
    }
    public function update()
    {
        Role::where('roleId', $this->roleId)->update([
            'role_name' => $this->name,
            'code' => str_replace(' ', '_', strtolower($this->name))
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Role berhasil diperbarui!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('roles.index', navigate:true);
    }
    #[Title('Update Role')]
    public function render()
    {
        return view('livewire.roles.role-edit');
    }
}
