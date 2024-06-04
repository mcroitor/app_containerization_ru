FROM php:7.4-fpm as base

# install pdo_sqlite extension
RUN apt-get update && \
    apt-get install -y sqlite3 libsqlite3-dev && \
    docker-php-ext-install pdo_sqlite

# create volume for sqlite database
VOLUME ["/var/www/db"]

# copy schema.sql
COPY sql/schema.sql /var/www/db/schema.sql

# initialize sqlite database
RUN echo "prepare database" && \
    cat /var/www/db/schema.sql | sqlite3 /var/www/db/db.sqlite && \
    chmod 777 /var/www/db/db.sqlite && \
    rm -rf /var/www/db/schema.sql && \
    echo "database is ready"

# copy site files
COPY site /var/www/html
