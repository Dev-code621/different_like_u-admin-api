<?php

namespace App\GraphQL\Mutations;

use App\Exceptions\CustomException;
use Joselfonseca\LighthouseGraphQLPassport\GraphQL\Mutations\BaseAuthResolver;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;

class ResendVerifyEmailMutation extends BaseAuthResolver
{
    /**
     * @param $rootValue
     * @param array                                                    $args
     * @param \Nuwave\Lighthouse\Support\Contracts\GraphQLContext|null $context
     * @param \GraphQL\Type\Definition\ResolveInfo                     $resolveInfo
     *
     * @throws \Exception
     *
     * @return array
     */
    public function resolve($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $email = trim($args['email']);
        $user = $this->findUser($email);

        if (empty($user)){
            throw new CustomException(
                'Email address does not exist!',
                'Please enter valid email address'
            );
        }

        if($user->email_verified_at) {
            throw new CustomException(
                'Your email has already been verified',
                'Please try to logging in'
            );
        }

        $user->sendEmailVerificationNotification();

        return [
            'message' => 'The verification email has been sent successfully to '.$email,
            'status' => 'SUCCESS',
        ];
    }

    /**
     * @param string $email
     * @return mixed
     */
    protected function findUser(string $email)
    {
        $model = $this->makeAuthModelInstance();

        if (method_exists($model, 'findForPassport')) {
            return $model->findForPassport($email);
        }

        return $model::query()
            ->role('Consumer')
            ->where('email', '=', $email)
            ->first();
    }
}
