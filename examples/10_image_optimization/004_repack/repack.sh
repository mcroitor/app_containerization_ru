#!/bin/bash

# script reads the image name from the command line and repacks it
# input parameter: <image name>:<tag>
# output: repacked image with named <image name>:<tag>-minimized

# check if the image name is provided
if [ -z "$1" ]; then
  echo "Usage: $0 <image_name>"
  exit 1
fi

# get the image name
image_full_name=$1

# extragerea numelui imaginii
image_name=$(echo $image_full_name | cut -d: -f1)
echo "image_name: ${image_name}"

# extragerea tag-ului imaginii
image_tag=$(echo $image_full_name | cut -d: -f2)
echo "image tag: ${image_tag}"

# check if the image exists
image_exists=$(docker image ls | grep ${image_name} | grep ${image_tag})
# echo ${image_exists}
if [ -z "${image_exists}" ]; then
  echo "Image ${image_full_name} does not exist"
  exit 1
fi


# Crearea containerului din imaginie
docker create --name ${image_name} ${image_name}:${image_tag}

# Crearea imaginii din container
docker export ${image_name} | docker import - ${image_name}:${image_tag}-minimized

# Stergerea containerului
docker rm ${image_name}

# Afisarea imaginilor
docker image ls | grep ${image_name}