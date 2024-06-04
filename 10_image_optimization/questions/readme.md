# Вопросы по теме "Оптимизация образа контейнера"

## Вопросы с выбором одного варианта из четырёх

1. Какой командой можно просмотреть список образов контейнеров?
   - [x] `docker images`
   - [ ] `docker ps`
   - [ ] `docker container ls`
   - [ ] `docker inspect`
2. Какой командой можно просмотреть информацию о слоях образа?
   - [x] `docker history`
   - [ ] `docker inspect`
   - [ ] `docker image ls`
   - [ ] `docker image inspect`
3. Дан Dockerfile:

   ```dockerfile
   FROM nginx:latest
   COPY ./site /usr/share/nginx/html
   ```

   Как можно уменьшить размер получаемого образа?
   - [x] заменить `nginx:latest` на `nginx:alpine`
   - [ ] использовать многоэтапную сборку
   - [ ] уменьшить количество слоев
   - [ ] использовать `.dockerignore`
4. Дан Dockerfile:

   ```dockerfile
   FROM nginx:alpine
   COPY ./site /usr/share/nginx/html
   ```

   Как можно уменьшить размер получаемого образа?
   - [x] хранить сайт в монтированном томе
   - [ ] использовать многоэтапную сборку
   - [ ] уменьшить количество слоев
   - [ ] использовать `.dockerignore`
5. Дан Dockerfile:

    ```dockerfile
    FROM debian:bookworm-slim
    RUN apt-get update && apt-get install -y php-cli
    RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
    ```

    Как можно уменьшить размер получаемого образа?
    - [x] объединить слои
    - [ ] использовать многоэтапную сборку
    - [ ] хранить данные в монтированном томе
    - [ ] использовать `.dockerignore`
6. Дан Dockerfile:

    ```dockerfile
    FROM gcc:latest
    COPY app.cpp .
    RUN g++ app.cpp -o app -static
    CMD ["./app"]
    ```

    Как можно уменьшить размер получаемого образа?
    - [x] использовать многоэтапную сборку
    - [ ] уменьшить количество слоев
    - [ ] хранить данные в монтированном томе
    - [ ] использовать `.dockerignore`
