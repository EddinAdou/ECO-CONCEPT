FROM php:8.2-fpm-alpine

RUN apk add --no-cache curl git build-base zlib-dev oniguruma autoconf bash && docker-php-ext-install pdo_mysql
RUN apk add --update linux-headers nodejs npm

COPY ./ /var/www/
WORKDIR /var/www/

#Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

CMD php-fpm

EXPOSE 9000