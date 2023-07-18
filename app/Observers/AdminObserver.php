<?php

namespace App\Observers;
use App\Admin;
use App\User;

class AdminObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Admin  $user
     * @return void
     */
    public function created(Admin $user)
    {

        if(isset($user->id)){
            $userData = User::where('id', $user->id)->firstOrFail();
            $userData->assignRole('AdminPanel');
        }
    }
}
