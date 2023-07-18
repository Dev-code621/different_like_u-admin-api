<?php

namespace Tests;

use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use MakesGraphQLRequests;

    public function installApp($mail = 'jose@example.com', $first_name = 'Jose', $last_name = 'Fonseca')
    {
        $service = app(\App\Services\Installation\AppInstallationService::class);
        $service->installApp([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $mail,
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
        ]);
    }

}
