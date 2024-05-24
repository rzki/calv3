<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Dashboard')]
    public function render()
    {
        return view('livewire.dashboard');
    }
}
