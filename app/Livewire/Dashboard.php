<?php

namespace App\Livewire;

use App\Models\Device;
use App\Models\LogBook;
use Livewire\Component;
use App\Models\Hospital;
use App\Models\Inventory;
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
        // dd(Auth::user());
        return view('livewire.dashboard', [
            'dashboardInventory' => Device::count(),
            'dashboardLogBook' => LogBook::count(),
            'dashboardAlat' => Device::count(),
            'dashboardRS' => Hospital::count()
        ]);
    }
}
