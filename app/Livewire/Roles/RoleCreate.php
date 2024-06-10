<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Spatie\Permission\Models\Role;

class RoleCreate extends Component
{
    public $name;
    public function create()
    {
        Role::create([
            'name' => $this->name
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Role berhasil ditambahkan!',
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
