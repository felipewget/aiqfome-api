#!/bin/bash

until nc -z -v -w30 postgres 5432
do
  echo "Postgres não está pronto ainda, tentando novamente..."
  sleep 5
done

# Migrations
php artisan migrate

# Seeders
php artisan db:seed --force

exec "$@"