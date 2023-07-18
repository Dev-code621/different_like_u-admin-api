<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class EditAccount extends Component
{
    public $firstName, $lastName, $email;
    protected $rules = [
        'firstName' => 'required',
        'lastName' => 'required',
        // 'email' => 'required|email|unique:users,email',
    ];

    public function mount()
    {
        $userDetail = User::where('id', Auth::id())->first();
        $this->firstName = $userDetail->name;
        $this->lastName = $userDetail->last_name;
        $this->email = $userDetail->email;
    }

    public function render()
    {
        // $this->email = 'su@gsj.com';
        return view('livewire.edit-account');
    }

    public function save()
    {
        $this->validate();
        $data['email'] = $this->email;
        $data['name'] = $this->firstName;
        $update = User::where('id', Auth::id())
                    ->update($data);

        session()->flash('message', 'Your information has been updated successfully.');
    }
}
