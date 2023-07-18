<?php

namespace App\GraphQL\Mutations;

use App\Exceptions\CustomException;
use App\Mail\MerchantMail;
use Faker\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

final class DeleteUser
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        //get login user details
        $user=Auth::user();
        //if login user id & delete user id not match than it's invalid user
        if ($user->id!=$args['id']){
            throw new CustomException(
                'Invalid User!',
                'You are invalid user!'
            );
        }
        $email=$user->email;
        //change user details to fake details
        $faker = Factory::create();
        $oldstr = $faker->email();
        $pos = strpos($oldstr,"@");
        $emailStr = substr($oldstr, 0, $pos) . '.del' . substr($oldstr, $pos);
        $user->name = 'Anonymous';
        $user->last_name = 'User';
        $user->email = $emailStr;
        $user->password = bcrypt('zazz@123');
        $user->save();

        //check if user have user name than change it anonymous user
        if (isset($user->userDetail) && !empty($user->userDetail)) {
            $user->userDetail->user_name = 'Anonymous User';
            $user->userDetail->save();
        }
        // email
        $template='emails.UserDeleted';
        $subject='Your Sacki Account is Deleted!';
        try {
            //sent confirmation email to user for successfully deleted account
            Mail::to($email)->send(new MerchantMail([], $template,$subject));
        }catch (\Exception $exception){}

        //application message
        return [
            'message' => "Your Account is deleted successfully!",
            'status' => 'SUCCESS',
        ];
    }
}
