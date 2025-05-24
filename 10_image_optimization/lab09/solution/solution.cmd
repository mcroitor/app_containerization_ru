rem clean
docker container prune --force
docker image prune --all --force

rem solution

docker image build -t mynginx:raw -f Dockerfile.raw .
docker image build -t mynginx:clean -f Dockerfile.clean .
docker image build -t mynginx:few -f Dockerfile.few .
docker image build -t mynginx:alpine -f Dockerfile.alpine .

rem repack
docker container create --name mynginx mynginx:raw
docker container export mynginx | docker image import - mynginx:repack
docker container rm mynginx

rem all
docker image build -t mynginx:minx -f Dockerfile.min .
docker container create --name mynginx mynginx:minx
docker container export mynginx | docker image import - mynginx:min
docker container rm mynginx

rem scan and check
rem docker scout quickview mynginx:raw
rem docker scout quickview mynginx:clean
rem docker scout quickview mynginx:few
rem docker scout quickview mynginx:alpine
rem docker scout quickview mynginx:repack
rem docker scout quickview mynginx:min
docker image list
