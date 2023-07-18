<?php

namespace App\Observers;

use Illuminate\Support\Str;
use Laravel\Passport\Client;

/**
 * Class ClientObserver.
 */
class ClientObserver
{
    /**
     * @param \Laravel\Passport\Client $client
     */
    public function creating(Client $client)
    {
        if (empty($client->secret)) {
            $client->secret = Str::random(40);
        }
    }
}
