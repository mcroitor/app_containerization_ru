# Лабораторная работа №6: Создание многоконтейнерного приложения

## Цель работы

Ознакомиться с работой многоконтейнерного приложения на базе `docker-compose`.

## Задание

Создать php приложение на базе трех контейнеров: nginx, php-fpm, mariadb, используя `docker-compose`.

## Подготовка

Для выполнения данной работы необходимо иметь установленный на компьютере [Docker](https://www.docker.com/).

Работа выполняется на базе лабораторной работы №5.

## Выполнение

Создайте репозиторий `containers06` и скопируйте его себе на компьютер.

### Сайт на php

В директории `containers06` создайте директорию `mounts/site`. В данную директорию перепишите сайт на php, созданный в рамках предмета по php.

### Конфигурационные файлы

Создайте файл `.gitignore` в корне проекта и добавьте в него строки:

```gitignore
# Ignore files and directories
mounts/site/*
```

Создайте в директории `containers06` файл `nginx/default.conf` со следующим содержимым:

```nginx
server {
    listen 80;
    server_name _;
    root /var/www/html;
    index index.php;
    location / {
        try_files $uri $uri/ /index.php?$args;
    }
    location ~ \.php$ {
        fastcgi_pass backend:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

Создайте в директории `containers06` файл `docker-compose.yml` со следующим содержимым:

```yaml
version: '3.9'

services:
  frontend:
    image: nginx:1.19
    volumes:
      - ./mounts/site:/var/www/html
      - ./nginx/default.conf:/etc/nginx/conf.d/default.conf
    ports:
      - "80:80"
    networks:
      - internal
  backend:
    image: php:7.4-fpm
    volumes:
      - ./mounts/site:/var/www/html
    networks:
      - internal
    env_file:
      - mysql.env
  database:
    image: mysql:8.0
    env_file:
      - mysql.env
    networks:
      - internal
    volumes:
      - db_data:/var/lib/mysql

networks:
  internal: {}

volumes:
  db_data: {}
```

Создайте файл `mysql.env` в корне проекта и добавьте в него строки:

```env
MYSQL_ROOT_PASSWORD=secret
MYSQL_DATABASE=app
MYSQL_USER=user
MYSQL_PASSWORD=secret
```

## Запуск и тестирование

Запустите контейнеры командой:

```bash
docker-compose up -d
```

Проверьте работу сайта в браузере, перейдя по адресу `http://localhost`. Если отображается базовая страница `nginx`, то перегрузите страницу.

## Создание отчета

Создайте в папке `containers06` файл `README.md` который содержать пошаговое выполнение проекта. Описание проекта должно содержать:

1. Название лабораторной работы.
2. Цель работы.
3. Задание.
4. Описание выполнения работы с ответами на вопросы.
5. Выводы.

Ответьте на вопросы:

1. В каком порядке запускаются контейнеры?
2. Где хранятся данные базы данных?
3. Как называются контейнеры проекта?
4. Вам необходимо добавить еще один файл `app.env` с переменной окружения `APP_VERSION` для сервисов `backend` и `frontend`. Как это сделать?

Выложите проект на GitHub.

## Представление

При представлении ответа прикрепите к заданию ссылку на репозиторий.

## Оценивание
