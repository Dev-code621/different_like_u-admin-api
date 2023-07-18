<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Log;
use Joselfonseca\LighthouseGraphQLPassport\GraphQL\Mutations\BaseAuthResolver;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

/**
 * Class SocialLogin.
 */
class SocialLogin extends BaseAuthResolver
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
        
        $credentials = $this->buildCredentials($args, 'social_grant');
        $response = $this->makeRequest($credentials);
        $model = $this->makeAuthModelInstance();
        $user = $model->where('id', Auth::user()->id)->firstOrFail();
        if(array_key_exists('fcm_token', $args) && is_null($user->fcm_token)) {
            Log::debug('resolve condition');
          $user->fcm_token = $args['fcm_token'];
          $user->save();
        }

        $response['user'] = $user;

        return $response;
    }
}
