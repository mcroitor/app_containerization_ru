# Solution

```bash
# create network `internal` for internal communication between containers
docker network create internal

# create php-fpm based container `backend` with mounted directory `mounts/site` to `/var/www/html`
docker run -d --name backend --network internal -v ./mounts/site:/var/www/html php:7.4-fpm

# create nginx based container `frontend` with mounted directory `mounts/site` to `/var/www/html` and mounted file `nginx/default.conf` to `/etc/nginx/conf.d/default.conf`
docker run -d --name frontend --network internal -v ./mounts/site:/var/www/html -v ./nginx/default.conf:/etc/nginx/conf.d/default.conf -p 80:80 nginx:1.23-alpine
```
