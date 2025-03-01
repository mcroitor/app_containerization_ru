#!/bin/bash
# solution

docker image build -t mynginx:raw -f Dockerfile.raw .
docker image build -t mynginx:clean -f Dockerfile.clean .
docker image build -t mynginx:few -f Dockerfile.few .
docker image build -t mynginx:alpine -f Dockerfile.alpine .

# repack
docker container create --name mynginx mynginx:raw
docker container export mynginx | docker image import - mynginx:repack
docker container rm mynginx

# all
docker image build -t mynginx:minx -f Dockerfile.min .
docker container create --name mynginx mynginx:minx
docker container export mynginx | docker image import - myngin:min
docker container rm mynginx

# scan and check
docker scout quickview mynginx:raw
docker scout quickview mynginx:clean
docker scout quickview mynginx:few
docker scout quickview mynginx:alpine
docker scout quickview mynginx:repack
docker scout quickview mynginx:min
docker image list
