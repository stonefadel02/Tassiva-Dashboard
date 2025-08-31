#!/usr/bin/env bash
set -e

# Génère la clé si absente
php artisan key:generate --force || true

# Optimisations de prod
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Migrations en prod
php artisan migrate --force || true

# Lance Nginx+PHP-FPM via supervisord (image webdevops)
exec /usr/bin/supervisord -n
