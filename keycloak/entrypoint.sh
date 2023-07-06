#!/usr/bin/env bash

exec docker run \
    -d \
    -p $INPUT_KEYCLOAK_HTTP_PORT:8080 \
    -e KEYCLOAK_ADMIN=$INPUT_KEYCLOAK_ADMIN_USER \
    -e KEYCLOAK_ADMIN_PASSWORD=$INPUT_KEYCLOAK_ADMIN_PASS \
    -v /$(pwd)/keycloak/realms/hub_realm.json:/opt/keycloak/data/import/hub_realm.json \
    quay.io/keycloak/keycloak:$INPUT_KEYCLOAK_VERSION \
    start-dev --import-realm
