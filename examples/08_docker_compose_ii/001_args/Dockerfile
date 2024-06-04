ARG DEBIAN_VERSION=stretch
FROM debian:${DEBIAN_VERSION}
ARG APP_VERSION

LABEL maintainer="Mihail Croitor <mcroitor@gmail.com>"
LABEL version="${APP_VERSION}"

RUN apt-get update && apt-get install -y apache2 \
    && rm -rf /var/lib/apt/lists/*

EXPOSE 80

CMD ["apache2ctl", "-D", "FOREGROUND"]
