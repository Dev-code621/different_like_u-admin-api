<?php

namespace App\GraphQL\Mutations;

use App\Exceptions\CustomException;
use App\User;
use Illuminate\Support\Facades\DB;

final class ForgotPassword
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        $email = $args['email'];
        $res = DB::table('users')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('roles.name', '=', 'Consumer')
            ->where('users.email', '=', $email);

        if (!$res->exists()){
            throw new CustomException(
                'Email address does not exist!',
                'Please enter valid email address'
            );
        }

        $fp = new \Joselfonseca\LighthouseGraphQLPassport\GraphQL\Mutations\ForgotPassword();

        $response = $fp->broker()->sendResetLink(['email' => $email]);

        return [
            'message' => __($response),
            'status' => 'EMAIL_SENT',
        ];
    }
}
