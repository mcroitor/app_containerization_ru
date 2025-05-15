ARG NGINX_VERSION=1.25.3-bookworm
FROM nginx:${NGINX_VERSION}

RUN apt-get update && apt-get upgrade -y

COPY ./default.conf /etc/nginx/conf.d/default.conf