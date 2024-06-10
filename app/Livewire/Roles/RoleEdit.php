<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Livewire\Attributes\Title;
use Spatie\Permission\Models\Role;

class RoleEdit extends Component
{
    public $roles, $id, $name, $code;
    public function mount($id)
    {
        $this->roles = Role::where('id', $id)->first();
        $this->name = $this->roles->role_name;
    }
    public function update()
    {
        Role::where('id', $this->id)->update([
            'name' => $this->name
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
