<?php

namespace App\Livewire\Users\RumahSakit;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;

class UserRumahSakitIndex extends Component
{
    use WithPagination;
    public $user, $userId;
    public $search,
        $perPage = 5;
    public $listeners = ['deleteConfirmed' => 'delete'];
    public function deleteConfirm($userId)
    {
        $this->userId = $userId;
        $this->dispatch('delete-confirmation');
    }
    public function delete()
    {
        $this->user = User::where('userId', $this->userId)->first();
        $this->user->delete();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'User berhasil dihapus!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('user-rs.index', navigate: true);
    }

    public function resetPassword($userId)
    {
        $this->userId = $userId;
        $this->user = User::where('userId', $this->userId)->update([
            'password' => Hash::make('Calibration24!')
        ]);

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Password berhasil direset!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('user-rs.index', navigate:true);
    }
    #[Title('Semua User')]
    public function render(User $user)
    {
        if($this->authorize('adminAccess', $user)){
            return view('livewire.users.rumah-sakit.user-rumah-sakit-index',[
                'userRS' => User::role('User')
                ->search($this->search)
                ->paginate($this->perPage)
            ]);
        }else{
            abort(403);
        }
    }
}
