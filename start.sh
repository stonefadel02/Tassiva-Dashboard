#!/usr/bin/env bash
set -e

cd /app

php artisan config:clear  || true
php artisan cache:clear   || true
php artisan route:clear   || true
php artisan view:clear    || true

php artisan config:cache  || true
php artisan migrate --force || true

# L’image webdevops utilise supervisord pour nginx + php-fpm
exec /usr/bin/supervisord -n
