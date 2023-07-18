<?php

namespace App\GraphQL\Mutations;

use App\Exceptions\CustomException;
use Joselfonseca\LighthouseGraphQLPassport\GraphQL\Mutations\BaseAuthResolver;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Register extends BaseAuthResolver
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
      $isEmailExist = $this->isEmailExist($email);

      if ($isEmailExist){
          throw new CustomException(
              'Email already exists, Please log in to continue using the application.',
              'Please use another email address'
          );
      }

      $model = $this->createAuthModel($args);

      $this->validateAuthModel($model);

      if ($model instanceof MustVerifyEmail) {
          $model->sendEmailVerificationNotification();

          $model->assignRole('Consumer');

          return [
              'tokens' => [],
              'status' => 'MUST_VERIFY_EMAIL',
          ];
      }
      $credentials = $this->buildCredentials([
          'username' => $args[config('lighthouse-graphql-passport.username')],
          'password' => $args['password'],
      ]);
      $user = $model->where(config('lighthouse-graphql-passport.username'), $args[config('lighthouse-graphql-passport.username')])->first();
      $response = $this->makeRequest($credentials);
      $response['user'] = $user;
      event(new Registered($user));

      return [
          'tokens' => $response,
          'status' => 'SUCCESS',
      ];
  }

  protected function validateAuthModel($model): void
  {
      $authModelClass = $this->getAuthModelFactory()->getClass();

      if ($model instanceof $authModelClass) {
          return;
      }

      throw new \RuntimeException("Auth model must be an instance of {$authModelClass}");
  }

  protected function createAuthModel(array $data): Model
  {
      $input = collect($data)->except('password_confirmation')->toArray();
      $input['password'] = Hash::make($input['password']);

      return $this->getAuthModelFactory()->create($input);
  }

    /**
     * @param string $email
     * @return mixed
     */
    protected function isEmailExist(string $email)
    {
        $model = $this->makeAuthModelInstance();

        if (method_exists($model, 'findForPassport')) {
            return $model->findForPassport($email);
        }

        return $model::query()
            ->role('Consumer')
            ->where('email', '=', $email)
            ->count();
    }
}
