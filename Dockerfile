# ---- builder ----
FROM composer:2 AS vendor
WORKDIR /app
COPY . .
RUN composer install --no-dev --prefer-dist --no-ansi --no-interaction --no-progress

# ---- runtime ----
FROM webdevops/php-nginx:8.2
WORKDIR /app

ENV WEB_DOCUMENT_ROOT=/app/public
ENV PHP_MEMORY_LIMIT=256M

# Extensions PHP (si dispo dans cette image)
RUN docker-php-ext-install pdo pdo_mysql

# Code + vendor
COPY --from=vendor /app /app

# Crée les dossiers Laravel + bons droits pour l'user "application"
RUN mkdir -p /app/storage/framework/{cache,sessions,views} \
    /app/storage/logs \
    /app/bootstrap/cache && \
    chown -R application:application /app/storage /app/bootstrap/cache && \
    chmod -R ug+rwX /app/storage /app/bootstrap/cache

# Script de démarrage
COPY start.sh /usr/local/bin/start.sh
RUN dos2unix /usr/local/bin/start.sh 2>/dev/null || true \
 && chmod +x /usr/local/bin/start.sh

# L’image lance supervisord (nginx+php-fpm). On passe par notre script.
CMD ["/usr/local/bin/start.sh"] corrige alors #!/usr/bin/env bash