#!/usr/bin/env bash

exec docker run \
    -d \
    -v "/$(pwd)/keycloak/realms/:/opt/keycloak/data/import/" \
    -p 8080:8080 \
    -e KEYCLOAK_ADMIN=admin \
    -e KEYCLOAK_ADMIN_PASSWORD=admin \
    quay.io/keycloak/keycloak:21.1 \
    start-dev --import-realm
