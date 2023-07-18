<?php

namespace Tests\Unit\Entities;

use Tests\TestCase;
use Laravel\Passport\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{

    use RefreshDatabase;

    function test_it_sets_secret_creating_a_client()
    {
        $client = Client::create([
            'name' => 'Client Name',
            'redirect' => 'https://localhost',
            'personal_access_client' => 0,
            'password_client' => 0,
            'revoked' => 0
        ]);
        $this->assertNotNull($client->secret);
    }
}
