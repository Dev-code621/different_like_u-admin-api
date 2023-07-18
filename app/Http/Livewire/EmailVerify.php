<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmailVerify extends Component
{
    public $email;
    public function resend()
    {
        Auth::user()->sendEmailVerificationNotification();
    }
    public function mount(){
        $resendSession = \Session::get('resend');
        if(!empty(Auth::user()->email)){
            $this->email = Auth::user()->email;
        }else{
            return redirect()->to('/merchant-login');
        }
        if(!empty($resendSession)){
            $this->resend();
        }
    }
    public function render()
    {
        return view('livewire.email-verify');
    }
}
