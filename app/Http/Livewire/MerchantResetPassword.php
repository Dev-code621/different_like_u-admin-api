<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Hash;
use DB;


class MerchantResetPassword extends Component
{
    public $email;
    public $user;

    public $isVisible = false;

    protected $rules = [
        'email' => 'required|email',
    ];
    public function render()
    {
        return view('livewire.merchant-reset-password');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetPassword()
    {
        $this->validate();
        $this->user = User::where('email', $this->email )->first();
        if($this->user){
            $this->resetMail();
            $this->isVisible = true;
        }
        else{
            session()->flash('message', $this->email.' does not exist.');
        }
    }

    public function resetMail()
    {
        $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($this->user);
            $objResetPasswordController = new ResetPasswordController();
            try {
                $data = $objResetPasswordController->sendMail($this->email, $token);
            } catch (Throwable $e) {
                report($e);
                session()->flash('error-message', 'Something went wrong.');
                return false;
            }
    }

    public function resendResetPassword()
    {
        $this->resetMail();
        session()->flash('message', 'Your reset password link has been sent successfully');
    }
}
