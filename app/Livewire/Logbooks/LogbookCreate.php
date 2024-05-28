<?php

namespace App\Livewire\Logbooks;

use Livewire\Component;
use Livewire\Attributes\Title;

class LogbookCreate extends Component
{
    #[Title('Tambah Log Book')]
    public function render()
    {
        return view('livewire.logbooks.logbook-create');
    }
}
