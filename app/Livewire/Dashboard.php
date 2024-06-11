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

class Dashboard extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Dashboard')]
    public function render()
    {
        return view('livewire.dashboard', [
            'dashboardInventory' => Inventory::count(),
            'dashboardLogBook' => LogBook::count(),
            'dashboardAlat' => Device::count(),
            'dashboardRS' => Hospital::count()
        ]);
    }
}
