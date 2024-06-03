<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Imports\UsersImport;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class UserImport extends Component
{
    use WithFileUploads;
    #[Validate('file|required|mimes:csv,xls,xlsx')]
    public $users;
    public function import()
    {
        Excel::import(new UsersImport, $this->users);

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User berhasil diimpor!',
            'toast'=> true,
            'position'=> 'top-end',
            'timer'=> 2500,
            'progbar' => true,
            'showConfirmButton'=> false
        ]);
        return $this->redirectRoute('users.index', navigate:true);
    }
    public function render()
    {
        return view('livewire.users.user-import');
    }
}
