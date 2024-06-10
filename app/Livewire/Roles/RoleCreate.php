<?php

namespace App\Livewire\Roles;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;

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
        if($this->authorize('viewRoles')){
            return view('livewire.roles.role-create');
        }else{
            return view('livewire.dashboard');
        }
    }
}
