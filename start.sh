#!/usr/bin/env bash
set -e

# Se positionner dans le répertoire de l'application
cd /app

# Vider tous les caches est la bonne pratique pour cet environnement
echo "Clearing Laravel caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Lancer les migrations
echo "Running database migrations..."
php artisan migrate --force

# Lancer les services Nginx et PHP-FPM
echo "Starting services..."
exec /usr/bin/supervisord -n