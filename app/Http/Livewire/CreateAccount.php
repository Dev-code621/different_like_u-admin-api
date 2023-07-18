<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;

class CreateAccount extends Component
{
    public $firstName, $lastName, $email, $password;

    protected $rules = [
        'firstName' => 'required',
        'lastName' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|regex:/^(?:(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!])\S*)$/',
    ];
    
    protected $messages = [
        'password.regex' => 'The password must contain uppercase, lowercase, numbers and special characters'
    ];

    public function createAccount()
    {
        $this->validate();
        $user = User::create([
            'name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
        $user->assignRole('Merchant');
        event(new Registered($user));
        auth()->login($user);
        return $this->redirect('/email-verify');
    }

    public function render()
    {
        return view('livewire.create-account');
    }
}
