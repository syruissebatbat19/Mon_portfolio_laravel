# Construction des fichiers frontend
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build


# Environnement Laravel
FROM serversideup/php:8.4-fpm-nginx

WORKDIR /var/www/html

COPY --chown=www-data:www-data . .

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist

COPY --from=frontend --chown=www-data:www-data \
    /app/public/build /var/www/html/public/build

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV NGINX_HTTP_PORT=10000