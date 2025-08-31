# ---- builder ----
FROM composer:2 AS vendor
WORKDIR /app
COPY . .
RUN composer install --no-dev --prefer-dist --no-ansi --no-interaction --no-progress
# RUN php artisan package:discover --ansi || true   # optionnel si artisan présent

# ---- runtime ----
FROM webdevops/php-nginx:8.2
WORKDIR /app
ENV WEB_DOCUMENT_ROOT=/app/public
# IMPORTANT: Render écoute sur $PORT. Ajustons nginx pour écouter $PORT
ENV PORT=10000
ENV PHP_MEMORY_LIMIT=256M

# Extensions
RUN docker-php-ext-install pdo pdo_mysql

# Code + vendor
COPY --from=vendor /app /app

# Permissions (on est root ici)
RUN chown -R root:root /app \
 && chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Script de start
COPY start.sh /usr/local/bin/start.sh
RUN dos2unix /usr/local/bin/start.sh 2>/dev/null || true \
 && chmod +x /usr/local/bin/start.sh

# Rester root (ne PAS mettre USER application ici)
# USER root

# L’image webdevops démarre nginx+php-fpm via son entrypoint.
# On remplace le CMD pour lancer notre script qui finira en foreground.
CMD ["/usr/local/bin/start.sh"]
