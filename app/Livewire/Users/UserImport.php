<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class UserImport extends Component
{
    use WithFileUploads;
    // #[Validate('file|required|mimes:csv,xls,xlsx')]
    public $users;
    public function import()
    {
        // dd($this->users);
        Excel::import(new UsersImport(), $this->users);

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User berhasil diimpor!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('users.index', navigate: true);
    }
    #[Title('Import User')]
    public function render()
    {
        if ($this->authorize('viewUsers')) {
            return view('livewire.users.user-import');
        } else {
            return view('livewire.dashboard');
        }
    }
}
