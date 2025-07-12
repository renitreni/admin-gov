<?php

namespace App\Livewire\Worker\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginLivewire extends Component
{
    public $username = '';
    public $password = '';

    protected $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::guard('worker')->attempt(['username' => $this->username, 'password' => $this->password])) {
            session()->regenerate();

            return redirect()->intended('/emergency');
        }

        $this->addError('username', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.worker.auth.login-livewire');
    }
}
