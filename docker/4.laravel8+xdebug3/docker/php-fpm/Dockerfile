FROM php:7.4-fpm-alpine

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY conf.d/xdebug.ini $PHP_INI_DIR/conf.d/
COPY conf.d/error_reporting.ini $PHP_INI_DIR/conf.d/