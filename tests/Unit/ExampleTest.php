<?php

namespace Tests\Unit;

use Exception;
use Illuminate\Support\Facades\Http;
use Jumbojett\OpenIDConnectClient;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    protected function setup(): void
    {
        parent::setUp();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
        // $this->assertIsArray($this->getConfigParams());
    }

    private function getOpenIdConnectClient()
    {
        return new OpenIDConnectClient(
            config('keycloak.authServerUrl'),
            config('keycloak.realm'),
            config('keycloak.clientSecret')
        );
    }

    private function getConfigParams(): array
    {
        try {
            $config_params = Http::get('http://localhost:8080/realms/hub-dev/.well-known/openid-configuration');
        } catch (Exception $e) {
            throw new HttpException(503, $e->getMessage());
        }

        return $config_params->collect()->toArray();
    }
}
