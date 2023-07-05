<?php

namespace App\Http\Middleware;

use App\Interfaces\Auronix\Auth\OpenIDConnecInterface;
use Closure;
use Illuminate\Http\Request;
use Jumbojett\OpenIDConnectClient;

class Keycloak
{
    public function handle(Request $request, Closure $next)
    {
        $oidc = $this->getOpenIdConnectClient();
        $oidc->providerConfigParam($this->getConfigParams());
        $session = $oidc->introspectToken(session('user-access-token', ''));

        if (! $session->active) {
            return redirect('/login');
        }

        return $next($request);
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
            $config_params = Http::get(config('keycloak.authServerUrl').'/realms/'.config('keycloak.realm').'/.well-known/openid-configuration');
        } catch (Exception $e) {
            throw new HttpException(503, 'Service Unavailable', null);
        }

        return $config_params->collect()->toArray();
    }
}
