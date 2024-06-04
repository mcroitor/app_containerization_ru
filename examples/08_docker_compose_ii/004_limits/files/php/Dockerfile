ARG PHP_VERSION=8.0.3
FROM php:${PHP_VERSION}-fpm

RUN apt-get update && apt-get upgrade -y \
	&& docker-php-ext-install -j$(nproc) pdo_mysql mysqli

COPY ./php.ini ${PHP_INI_DIR}/php.ini