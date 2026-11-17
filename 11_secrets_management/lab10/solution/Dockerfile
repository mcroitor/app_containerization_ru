FROM php:8.4.27-fpm AS base

# install pdo_mysql extension
RUN apt-get update && \
    apt-get install -y libzip-dev && \
    docker-php-ext-install pdo_mysql

# copy site files
COPY site /var/www/html
