<?php

namespace App\Services\Installation;

use App\User;
use Closure;
use Laravel\Passport\ClientRepository;

/**
 * Class CreatePassportClient.
 */
class CreatePassportClient
{
    /**
     * @var \Laravel\Passport\ClientRepository
     */
    public $client;

    /**
     * CreatePassportClient constructor.
     *
     * @param \Laravel\Passport\ClientRepository $client
     */
    public function __construct(ClientRepository $client)
    {
        $this->client = $client;
    }

    /**
     * @param $installationData
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($installationData, Closure $next)
    {
        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'Super Administrator');
        })->first();
        $this->client->create($user->id, 'Default OAuth client Password', url('/oauth/client/callback'), false, true);
        $this->client->create($user->id, 'Default OAuth client Authorize', url('/oauth/client/callback'), false, false);
        $next($installationData);
    }
}
