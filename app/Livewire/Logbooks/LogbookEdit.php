<?php

namespace App\Livewire\Logbooks;

use Livewire\Component;
use Livewire\Attributes\Title;

class LogbookEdit extends Component
{
    #[Title('Edit Log Book')]
    public function render()
    {
        return view('livewire.logbooks.logbook-edit');
    }
}
