<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

class ResetSuperadmin extends Component
{
    public function resetSuperAdmin()
    {
        User::where('id', '=', 1)->update([
            'password' => Hash::make('CalSadmin24!')
        ]);

        return $this->redirect('/', navigate: true);
    }
    #[Title('Reset Superadmin')]
    #[Layout('components.layout.public')]
    public function render()
    {
        return view('livewire.reset-superadmin');
    }
}
