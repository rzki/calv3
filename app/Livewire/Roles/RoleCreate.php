<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

class RoleCreate extends Component
{
    public $name, $code;
    public function create()
    {
        Role::create([
            'roleId' => Str::orderedUuid(),
            'name' => $this->name,
            'code' => str_replace(' ', '_', strtolower($this->name))
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Role berhasil dihapus!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('roles.index', navigate:true);
    }
    #[Title('Tambah Role')]
    public function render()
    {
        return view('livewire.roles.role-create');
    }
}
