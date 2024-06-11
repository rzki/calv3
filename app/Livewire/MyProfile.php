<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;

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

    }
    public function render()
    {
        return view('livewire.my-profile');
    }
}
