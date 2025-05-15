# example of using ENV instruction
# environment variable is available during the build process (in the CMD instruction)
# to build the image use the following command:
# docker build --build-arg DEBIAN_VERSION=buster --build-arg SAMPLE=sometext -t my_image .
# to run the container use the following command:
# docker run my_image

# debian based image
ARG DEBIAN_VERSION=latest
FROM debian:${DEBIAN_VERSION}

# ARG instruction
ARG PHP_VERSION=8.2

# ENV instruction
ENV PHP_VERSION=${PHP_VERSION} PHP=php${PHP_VERSION}
ENV PHP_EXTENSIONS="${PHP}-gd ${PHP}-mysql ${PHP}-xml"

RUN apt-get update && apt-get install -y ${PHP} ${PHP_EXTENSIONS}

# run command
CMD ["/usr/bin/php", "-v"]
