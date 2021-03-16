FROM php:7.4-fpm-alpine

COPY ./ var/www/html

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

RUN chown laravel:laravel /var/www/html

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

CMD php artisan serve --host=0.0.0.0 --port=80
