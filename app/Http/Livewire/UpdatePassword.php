<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class UpdatePassword extends Component
{
    /** @var string */
    public $password = '';
    public $password_confirmation = '';
    public $error;

    protected $rules = [
            'password' => 'required|string|min:8|regex:/^(?:(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!])\S*)$/',
            'password_confirmation' => 'required|confirmed',
        ];

    protected $messages = [
        'password.regex' => 'The password must contain uppercase, lowercase, numbers and special characters'
    ];

    public function render()
    {
        return view('livewire.update-password');
    }

    public function save()
    {
        $this->validate();

        $update = User::where('id', Auth::id())
                    ->update(['password' => Hash::make($this->password)]);

        session()->flash('message', 'Your password has been updated successfully.');
    }
}
