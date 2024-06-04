# network sample

Два контейнера `frontend` и `backend` работают в одной сети. 

В контейнере `frontend` запущен веб-сервер `nginx`, в контейнере `backend` - `php-fpm`.

Контейнер `frontend` создается на базе файла `dockerfile.nginx`, контейнер `backend` на базе файла `dockerfile.backend`.

```bash
docker network create frontend
docker network create backend
docker build -t frontend -f dockerfile.frontend .
docker build -t backend -f dockerfile.backend .
docker run -d --name backend backend
docker network connect backend backend
docker run -d -p 80:80 --name frontend frontend
docker network connect backend frontend
```

```bash
docker network create local
docker build -t frontend -f dockerfile.frontend .
docker build -t backend -f dockerfile.backend .
docker run -d --name backend backend
docker network connect --alias php-fpm local backend
docker run -d --publish 80:80 --name frontend frontend
docker network connect local frontend
```
