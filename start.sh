#!/usr/bin/env bash
set -e

# Attendre que MySQL soit up (5s par ex)
sleep 5

# Artisan commandes
php artisan config:clear || true
php artisan cache:clear  || true
php artisan route:clear  || true
php artisan view:clear   || true

# Si APP_KEY vide → le générer
if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force
fi

php artisan config:cache   || true
php artisan migrate --force || true
php artisan view:cache     || true

# Lancer supervisord (nginx + php-fpm)
exec /usr/bin/supervisord -n
