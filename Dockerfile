FROM php:8.2-fpm

RUN apt-get update && apt-get install -y git unzip libzip-dev libpng-dev libonig-dev libxml2-dev

RUN docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/scoring

COPY scoring-app .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

CMD ["php-fpm"]
