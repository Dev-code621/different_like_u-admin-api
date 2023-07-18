<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use Illuminate\Support\Facades\Auth;

class MerchantLogin extends Component
{
    public $password, $email;

    protected $rules = [
        'password' => 'required|min:6',
        'email' => 'required|email',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $validatedDate = $this->validate();

        if(Auth::attempt(array('email' => $this->email, 'password' => $this->password))){
            $this->redirect('/merchant-dash/home');
        }else{
            $this->addError('password', 'Invalid login');
        }
    }
    public function render()
    {
        return view('livewire.merchant-login');
    }
}
