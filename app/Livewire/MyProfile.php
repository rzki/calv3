<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyProfile extends Component
{
    public $nama, $email, $username;
    #[Validate('nullable|string|confirmed|min:8')]
    public $password;
    public function mount()
    {
        $this->nama     = Auth::user()->name;
        $this->email    = Auth::user()->email;
        $this->username = Auth::user()->username;
    }
    public function updateProfile()
    {
        if($this->password){
            auth()->user()->update(['password' => Hash::make($this->password)]);
        }

        auth()->user()->update([
            'name' => $this->nama,
            'email' => $this->email,
            'username' => $this->username
        ]);
        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Profil berhasil diubah!',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2500,
            'progbar' => true,
            'showConfirmButton' => false,
        ]);
        return $this->redirectRoute('profiles.show', navigate: true);
    }
    #[Title('Profil Saya')]
    public function render()
    {
        return view('livewire.my-profile');
    }
}
