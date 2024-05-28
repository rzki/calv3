<?php

namespace App\Livewire\Logbooks;

use Livewire\Attributes\Title;
use Livewire\Component;

class LogbookIndex extends Component
{
    #[Title('Log Book')]
    public function render()
    {
        return view('livewire.logbooks.logbook-index');
    }
}
