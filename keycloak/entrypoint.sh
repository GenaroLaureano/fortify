#!/usr/bin/env bash
echo "hello miss"
cat $(pwd)/keycloak/realms/hub_realm.json

exec docker run \
    -d \
    -p $INPUT_KEYCLOAK_HTTP_PORT:8080 \
    -e KEYCLOAK_ADMIN=$INPUT_KEYCLOAK_ADMIN_USER \
    -e KEYCLOAK_ADMIN_PASSWORD=$INPUT_KEYCLOAK_ADMIN_PASS \
    -v "/realms":"/opt/keycloak/data/import" \
    quay.io/keycloak/keycloak:$INPUT_KEYCLOAK_VERSION \
    start-dev --import-realm
