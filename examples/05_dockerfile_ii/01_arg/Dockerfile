# example of using ARG instruction
# Builded container shows passed arguments
# docker build --build-arg DEBIAN_VERSION=buster --build-arg VAR=sometext -t my_image .
# to run the container use the following command:
# docker run my_image

# debian based image
# ARG instruction
ARG DEBIAN_VERSION=latest
FROM debian:${DEBIAN_VERSION}

ENV DEBIAN_VERSION=${DEBIAN_VERSION}
# ARG instruction
ARG VAR
ENV VAR=${VAR}

CMD echo "VERSION: ${DEBIAN_VERSION}, VAR: ${VAR}"
