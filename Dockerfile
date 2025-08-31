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

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=vendor /app /app

# (on est encore root ici)
RUN chown -R application:application /app/storage /app/bootstrap/cache

# copier et rendre exécutable AVANT de changer d’utilisateur
COPY start.sh /usr/local/bin/start.sh
RUN dos2unix /usr/local/bin/start.sh 2>/dev/null || true \
 && chmod +x /usr/local/bin/start.sh \
 && chown application:application /usr/local/bin/start.sh

# seulement maintenant on passe en user non-root
USER application

CMD ["/usr/local/bin/start.sh"]
