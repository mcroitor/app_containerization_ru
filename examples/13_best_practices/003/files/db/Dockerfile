FROM mariadb:10.4

RUN apt-get update && apt-get upgrade -y

COPY ./install.sql /docker-entrypoint-initdb.d/install.sql
