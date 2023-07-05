<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ControllerTest extends Controller
{

    public function index()
    {
        return $this->getConfigParams();
    }

    private function getOpenIdConnectClient()
    {
        return new OpenIDConnectClient(
            config('keycloak.authServerUrl'),
            config('keycloak.realm'),
            config('keycloak.clientSecret')
        );
    }

    private function getConfigParams()
    {
        try {
            $config_params = Http::get(config('keycloak.authServerUrl').'/realms/'.config('keycloak.realm').'/.well-known/openid-configuration');
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $config_params->collect()->toArray();
    }
}
