<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;

class UserIndex extends Component
{
    public $search, $perPage = 5;
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
