<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class UserImport extends Component
{
    use WithFileUploads;
    // #[Validate('file|required|mimes:csv,xls,xlsx')]
    public $users;
    public function import()
    {
        // Store file to temp folder
        $originalPath = $this->users->store('file-temp');
        $newPath = storage_path('app').'/'.$originalPath;
        // Execute stored temp file
        Excel::import(new UsersImport(), $newPath);
        // delete temp file
        Storage::disk('local')->delete($newPath);

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
    public function render(User $user)
    {
        if ($this->authorize('adminAccess', $user)) {
            return view('livewire.users.user-import');
        } else {
            return view('livewire.dashboard');
        }
    }
}
