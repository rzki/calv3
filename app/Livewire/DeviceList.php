<?php

namespace App\Livewire;

use App\Models\Device;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class DeviceList extends Component
{
    use WithPagination;
    public $perPage = 5, $search;
    #[Title('List Alat')]
    #[Layout('components.layouts.public')]
    public function render()
    {
        return view('livewire.device-list',[
            'listAlat' => Device::orderByDesc('created_at')
                            ->search($this->search)
                            ->paginate($this->perPage)
        ]);
    }
}
