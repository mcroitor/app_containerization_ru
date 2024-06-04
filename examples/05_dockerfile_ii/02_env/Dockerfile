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
ARG SAMPLE

# ENV instruction
ENV SAMPLE=${SAMPLE}

# run command
CMD echo "Sample: ${SAMPLE}"
