<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ResetSuperadmin extends Component
{
    public function resetSuperAdmin()
    {
        User::where('id', '=', 1)->update([
            'password' => Hash::make('CalSadmin24!')
        ]);

        return $this->redirect('/', navigate: true);
    }
    public function render()
    {
        return view('livewire.reset-superadmin');
    }
}
