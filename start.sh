#!/usr/bin/env sh
echo "Start podman-compose"
podman-compose up -d
echo "Start Symfony Dev-Server"
symfony server:start -d