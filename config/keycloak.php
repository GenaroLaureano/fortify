<?php

return [
    'authServerUrl' => env('KEYCLOAK_AUTH_SERVER_URL'),
    'realm' => env('KEYCLOAK_REALM'),
    'clientId' => env('KEYCLOAK_CLIENT_ID'),
    'clientSecret' => env('KEYCLOAK_CLIENT_SECRET'),
    'redirectUri' => env('KEYCLOAK_REDIRECT_URI'),
    'username' => env('KEYCLOAK_USERNAME'),
    'password' => env('KEYCLOAK_PASSWORD')
];