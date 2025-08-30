FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    bash \
    git \
    libzip-dev \
    zip \
    unzip \
    oniguruma-dev \
    postgresql-dev \
    $PHPIZE_DEPS

RUN docker-php-ext-install pdo pdo_pgsql mbstring zip bcmath

RUN pecl install redis \
    && docker-php-ext-enable redis

WORKDIR /app

EXPOSE 9000

CMD ["php-fpm"]