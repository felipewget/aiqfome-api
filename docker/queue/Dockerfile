FROM php:8.2-fpm-alpine

WORKDIR /app

COPY . /app
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

CMD ["php", "/app/artisan", "queue:listen", "--queue=high,default", "--verbose", "--tries=3", "--timeout=0"]