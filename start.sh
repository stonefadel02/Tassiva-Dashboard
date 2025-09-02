#!/usr/bin/env bash
set -e

php artisan config:clear  || true
php artisan cache:clear   || true
php artisan route:clear   || true
php artisan view:clear    || true

php artisan config:cache  || true
php artisan migrate --force || true

# lance nginx + php-fpm (image webdevops)
exec /usr/bin/supervisord -n
