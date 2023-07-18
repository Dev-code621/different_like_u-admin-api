<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;


class CreateNewPass extends Component
{

    /** @var string */
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $error;
    public $token;

    protected $rules = [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|regex:/^(?:(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!])\S*)$/',
            'password_confirmation' => 'required|confirmed',
        ];

    protected $messages = [
        'password.regex' => 'The password must contain uppercase, lowercase, numbers and special characters'
    ];

    public function render()
    {
        return view('livewire.create-new-pass');
    }

    public function mount(Request $request, $token = null)
    {
        $this->token = $token;
        $this->email = $request->email;
    }

    public function passwordUpdate()
    {
        $this->validate();
        $validate = $this->validateNewPassword();
        if($validate == false){
            return false;
        }
        $user = User::select('password')->where('email', $this->email)->first();

        if(!(Hash::check($this->password, $user->password))){
            User::where('email', $this->email)
                    ->update(['password' => Hash::make($this->password)]);
            DB::table('password_resets')->where(['email'=> $this->email])->delete();
            session()->flash('reset-message', 'Your password has been updated successfully.');
            return redirect()->to('/merchant-login');
        }
        else{
            $this->error = 'Your password must be different from previously used passwords!';
        }
    }

    public function validateNewPassword()
    {
        $getRecord = DB::table('password_resets')
                    ->where(['email' => $this->email])
                    ->first();
        $tokenExpired = Carbon::parse($getRecord->created_at)->addHour('2')->isPast();

        if(!$getRecord){
            $this->error = 'This password reset token is invalid.';
            return false;
        }

        if(!(Hash::check($this->token, $getRecord->token))){
            $this->error = 'This password reset token is invalid.';
            return false;
        }

        if($tokenExpired){
            $this->error = 'This password reset token is expired.';
            return false;
        }
        return true;
    }
}
