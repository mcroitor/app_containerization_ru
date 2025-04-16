# network sample

Два контейнера `frontend` и `backend` работают в одной сети.

В контейнере `frontend` запущен веб-сервер `nginx`, в контейнере `backend` - `php-fpm`.

Контейнер `frontend` создается на базе файла `dockerfile.nginx`, контейнер `backend` на базе файла `dockerfile.backend`.

```bash
docker network create network
docker build -t frontend -f dockerfile.frontend .
docker build -t backend -f dockerfile.backend .
docker run -d --name backend backend
docker network connect network backend
docker run -d -p 80:80 --name frontend frontend
docker network connect network frontend
```
