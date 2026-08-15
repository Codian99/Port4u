#!/bin/sh
set -e

cd /app

# Ensure an application key exists. Use the environment value when provided,
# otherwise fall back to a key persisted in /app/.env (so container restarts
# reuse the same key), otherwise generate and persist a fresh one.
if [ -z "$APP_KEY" ]; then
  APP_KEY=$(grep '^APP_KEY=base64:' /app/.env 2>/dev/null | head -n1 | cut -d'=' -f2-)
fi

if [ -z "$APP_KEY" ]; then
  echo "[entrypoint] APP_KEY is not set - generating one..."
  APP_KEY="base64:$(openssl rand -base64 32)"
  printf 'APP_KEY=%s\n' "$APP_KEY" >> /app/.env
fi

export APP_KEY

php artisan config:cache
php artisan route:cache
php artisan migrate --force

# db:seed --force is safe here: the seeders only insert rows on a fresh
# database, so restarts never reset the admin password or seeded content.
php artisan db:seed --force --no-interaction

exec php artisan serve --host=0.0.0.0 --port=8000
