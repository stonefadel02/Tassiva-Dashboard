# ---- builder ----
FROM composer:2 AS vendor
WORKDIR /app

# Copie TOUT le projet d'abord (artisan sera là)
COPY . .
RUN composer install --no-dev --prefer-dist --no-ansi --no-interaction --no-progress
# (facultatif) php artisan package:discover --ansi || true

# ---- runtime: Nginx + PHP-FPM ----
FROM webdevops/php-nginx:8.2
WORKDIR /app
ENV WEB_DOCUMENT_ROOT=/app/public

# Extensions PHP nécessaires pour Laravel + MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copie du code + vendor
COPY --from=vendor /app /app

# Permissions Laravel
RUN chown -R application:application /app/storage /app/bootstrap/cache
USER application

# Script de démarrage (migrations, caches…)
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8080
ENV WEB_PHP_SOCKET=127.0.0.1:9000
ENV PORT=8080
CMD ["/start.sh"]
