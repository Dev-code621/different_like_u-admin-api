<?php

namespace App\GraphQL\Mutations;

use App\Exceptions\CustomException;
use Joselfonseca\LighthouseGraphQLPassport\GraphQL\Mutations\BaseAuthResolver;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Joselfonseca\LighthouseGraphQLPassport\Events\UserLoggedIn;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Login extends BaseAuthResolver
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
      $credentials = $this->buildCredentials($args);
      $user = $this->findUser($args['username']);
      if (empty($user)){
          throw new CustomException(
              'Email address does not exist!',
              'User does not exist!'
          );
      }
      $response = $this->makeRequest($credentials);

      if(!$user->hasVerifiedEmail()) {
          throw new CustomException(
              'Verify Your Email',
              'Check your email to verify your account before logging in'
          );
      }

      $this->validateUser($user);

      //adding the fcm token from arguments
      if(array_key_exists('fcm_token', $args) && is_null($user->fcm_token)) {
        $user->fcm_token = $args['fcm_token'];
        $user->save();
      }

      event(new UserLoggedIn($user));

      return array_merge(
          $response,
          [
              'user' => $user,
          ]
      );
    }

    protected function validateUser($user)
    {
        $authModelClass = $this->getAuthModelClass();
        if ($user instanceof $authModelClass && $user->exists) {
            return;
        }

        throw (new ModelNotFoundException())
            ->setModel($authModelClass);
    }

    protected function findUser(string $username)
    {
        $model = $this->makeAuthModelInstance();

        if (method_exists($model, 'findForPassport')) {
            return $model->findForPassport($username);
        }

        return $model::query()
            ->where(config('lighthouse-graphql-passport.username'), $username)
            ->first();
    }
}
