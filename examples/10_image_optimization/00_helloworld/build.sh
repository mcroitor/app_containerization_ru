#!/bin/bash

echo "Building helloworld-build image..."
docker build -t helloworld-build -f dockerfile_build .

echo "Extracting helloworld binary..."
docker create --name extract helloworld-build
mkdir -p app
docker cp extract:/app/helloworld app/helloworld
docker rm -f extract

echo "Building helloworld-run image..."
docker build -t helloworld-run -f dockerfile_run .
rm -f app/helloworld
